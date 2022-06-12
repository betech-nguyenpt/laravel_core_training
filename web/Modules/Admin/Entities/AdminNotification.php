<?php

namespace Modules\Admin\Entities;

use App\Entities\BaseModel;
use App\Events\PusherEvent;
use App\Utils\CommonProcess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @author Anh-VCT
 * 
 * This is the model class for table "admin_notification".
 *
 * @property int $id                     Id
 * @property tinyInt $type               Type [1: Send all, 2: send role, 3: send one user] (Default : 1)
 * @property int $receiver_id            Receiver Id
 * @property string $content             Content of notification
 * @property string $url                 URL to change
 * @property tinyInt $status             Status [1 : active, 2 : sent, 3 : read] (Default : 1)
 * @property int $created_by             Created by
 * @property timestamp $create_at        Create time
 * @property timestamp $update_at        Update time
 */

class AdminNotification extends BaseModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    /** Send type */
    const TYPE_SEND_ALL         = '1';
    const TYPE_SEND_ROLE        = '2';
    const TYPE_SEND_ONE         = '3';

    /** Status */
    const STATUS_ACTIVE         = '1';
    const STATUS_SENT           = '2';
    const STATUS_READ           = '3';

    /** Send type array */
    public const SEND_TYPE_ARRAY = [
        self::TYPE_SEND_ALL => 'SEND ALL',
        self::TYPE_SEND_ROLE => 'SEND ROLE',
        self::TYPE_SEND_ONE => 'SEND ONE',
    ];

    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'type', 'receiver_id', 'content', 'url', 'status', 'created_by', 'create_at', 'update_at',
    ];

    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * Send a notify to event Pusher and update status
     * 
     * @return void 
     */
    public function delivery()
    {
        event(new PusherEvent($this->type, $this->content, $this->url, $this->receiver_id));
        $this->updateStatus(self::STATUS_SENT); // After delivery to pusher, status will be update STATUS_SENT
    }

    /**
     * Update and save status 
     * 
     * @param  int $status           Status want to update
     * @return void
     */
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    /**
     * Table admin_users inner join admin_notifications
     * one_id               Id of notification
     * many_id              Id of user
     * admin_one_many.type  Type of admin_one_many ( TYPE_NOTIFICATION_USER = 2)
     * 
     * @return null | Obj   List of user has the same one_id
     */
    public function rUsers()
    {
        return $this->belongsToMany(AdminUser::class, AdminOneMany::class, 'one_id', 'many_id')
            ->where('admin_one_many.type', AdminOneMany::TYPE_NOTIFICATION_USER);
    }

    /**
     * Mark as read a record notification
     *      TYPE_SEND_All       Insert a record to admin_one_many
     *      TYPE_SEND_ROLE      Insert a record to admin_one_many
     *      TYPE_SEND_ONE       Update status to STATUS_READ
     * 
     * @return true | false
     */
    public function markAsRead()
    {
        $retVal = false;
        if ($this->type == self::TYPE_SEND_ONE) {
            if ($this->status == self::STATUS_SENT) {
                $this->status = self::STATUS_READ;
            }
            $retVal = $this->save();
        } else {
            $currentUserId = Auth::user()->id;
            // Check if notification was read before
            $retVal = AdminOneMany::checkExist($this->id, $currentUserId, AdminOneMany::TYPE_NOTIFICATION_USER);
            if (!$retVal) {
                $retVal = (AdminOneMany::insertOne($this->id, $currentUserId, AdminOneMany::TYPE_NOTIFICATION_USER) != null);
            }
        }
        return $retVal;
    }

    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public static function getRules()
    {
        return [
            'type'              => 'required | numeric |between:1,3',
            'receiver_id'       => 'required | numeric',
            'content'           => 'required',
        ];
    }

    /**
     * Insert a record to admin_notifications
     * 
     * @param  int $type                    Type [1: Send all, 2: send role, 3: send one user] (Default : 1)     
     * @param  int $receiver_id             Receiver Id
     * @param  String $content              Content of notification
     * @param  String $url                  URL to change
     * @return Obj Record was inserted      Created by
     */
    public static function insertOne($type, $receiver_id, $content, $url)
    {
        $mNotify                = new AdminNotification();
        $mNotify->type          = $type;
        $mNotify->receiver_id   = $receiver_id;
        $mNotify->content       = $content;
        $mNotify->url           = $url;
        $mNotify->save();
        return $mNotify;
    }

    /**
     * Send notify to pusher
     * 
     * @param  int $type                    Type [1: Send all, 2: send role, 3: send one user]
     * @param  int $receiver_id             Receiver Id
     * @param  String $content              Content of notification
     * @param  String $url                  URL to change
     * @return void
     */
    public static function send($type, $receiver_id, $content, $url)
    {
        $notify = self::insertOne($type, $receiver_id, $content, $url); // Insert to Admin_Notification and delivery notify to pusher
        if ($notify) {
            $notify->delivery();
        }
    }

    /**
     * Get all notification of user
     * To check notify is read or not:  
     *      TYPE_SEND_ONE:      $notify->status            (STATUS_SENT: unread, STATUS_READ: read)
     *      TYPE_SEND_ROLE:     $notify->rUsers->isEmpty() (true: unread, false: read)
     *      TYPE_SEND_ALL:      $notify->rUsers->isEmpty() (true: unread, false: read)
     * 
     * 
     * @return [] | Obj
     */
    public static function getCurrentUserNotifications()
    {
        // Get all mark as read notifications of current user through rUsers
        $allNotifies = self::with(['rUsers' => function ($query) {
            $query->where('admin_one_many.many_id', Auth::user()->id)->select('username');
        }])

            // Get all notifications of current user in table admin_notifications
            ->where(
                function ($query) {
                    $query->where('status', self::STATUS_SENT)
                        ->orWhere('status', self::STATUS_READ);
                }
            )->where(function ($query) {
                $query->where([
                    'type' => self::TYPE_SEND_ALL
                ]);
                $query->orWhere(function ($query) {
                    $query->where([
                        'type' => self::TYPE_SEND_ONE,
                        'receiver_id' => Auth::user()->id,
                    ]);
                });
                $query->orWhere(function ($query) {
                    $query->where([
                        'type' => self::TYPE_SEND_ROLE,
                        'receiver_id' => Auth::user()->role_id,
                    ]);
                });
            })->orderBy('id', 'desc')->get();

        if ($allNotifies) {
            return $allNotifies;
        }
        return [];
    }

    /**
     * Mark all notification of current user as read
     * 
     * @return boolean
     */
    public static function markAllAsRead()
    {
        DB::transaction(function () {
            $notifies = self::getCurrentUserNotifications();
            foreach ($notifies as $notify) {
                if ($notify->rUsers->isEmpty()) {
                    if (!$notify->markAsRead()) {
                        throw new \Exception('Error was occured when handle make all notifications as read');
                    }
                }
            }
        });
        return true;
    }
}
