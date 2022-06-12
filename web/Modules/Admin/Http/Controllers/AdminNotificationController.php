<?php

namespace Modules\Admin\Http\Controllers;

use App\Utils\DomainConst;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Entities\AdminNotification;
use Modules\Admin\Entities\AdminRole;
use Modules\Admin\Entities\AdminUser;

class AdminNotificationController extends BaseAdminController
{
    /** Class of model */
    public $modelClass = '\Modules\Admin\Entities\AdminNotification';
    /** Name of controller */
    public $controllerName = 'admin-notification';

    /**
     * Mark one notification as read
     * url: admin/admin-notification/read/{id}
     * type: post
     *
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
        $notify = AdminNotification::find($id);
        if ($notify->markAsRead()) {
            return response([
                'status'    => DomainConst::NUMBER_ONE_VALUE,
            ]);
        } else {
            return response([
                'status'    => DomainConst::NUMBER_ZERO_VALUE,
            ]);
        };
    }

    /**
     * Get all notification of current User
     *
     * @return json(['allNotifies' => $retVal])
     */
    public function getAll()
    {
        $retVal = [];
        if (Auth::check()) {
            $retVal = AdminNotification::getCurrentUserNotifications();
        }
        return response()->json(['allNotifies' => $retVal]);
    }

    /**
     * Read all notification of current User
     * url: admin/admin-notification/readAll
     * type: post
     * 
     * @return boolean  
     */
    public function readAll()
    {
        $retVal = false;
        try {
            $retVal = AdminNotification::markAllAsRead();
        } catch (\Exception $e) {
            // Catch exception when handle make all notifications as read
        }
        return response()->json(['status' => $retVal]);
    }

    /**
     * Show the demo view of admin-notification.
     *
     * @return \Illuminate\Http\Response
     */
    public function demo()
    {
        $model = new $this->modelClass();
        $controller = $this->controllerName;
        $typeArr = AdminNotification::SEND_TYPE_ARRAY;
        return view('admin::admin-notification.demo', compact('model', 'typeArr', 'controller'));
    }

    /**
     * Store and send notification
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'content' => 'required',
        ]);

        AdminNotification::send($request->type, $request->receiver_id, $request->content, $request->url);
        return redirect()->back()->with('sendSuccess', 'Notify has been sent');
    }
}
