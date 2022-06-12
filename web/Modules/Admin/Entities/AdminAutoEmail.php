<?php

namespace Modules\Admin\Entities;

use Mail;
use Redirect;
use App\Mail\SendEmail;
use Modules\Admin\Entities\AdminRecordLog;
use App\Utils\CommonProcess;

/**
 * This is the model class for table "admin_auto_emails".
 *
 * @property int $id                Id
 * @property string $subject        Subject
 * @property string $content        Content
 * @property string $sent_to        Sent to
 * @property int $type              Type
 * @property datetime $time_sent    Time sent
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminAutoEmail extends AdminModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    const TYPE_ANNOUNCE              = '1';
    const TYPE_CAMPAIGN              = '2';
    const STATUS_SUCCESS             = '2';
    const STATUS_FAILED              = '3';
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'subject', 'content', 'sent_to', 'type', 'time_sent', 'status', 'created_by'
    ];

    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('admin/admin-auto-emails', ['id' => $this->id]);
    }

    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public static function getRules()
    {
        return [];
    }
    
    /**
     * Get array status email
     * @return Array Status
     */
    public static function getArrayStatus() {
        $retVal = parent::getArrayStatus();
        $retVal[self::STATUS_ACTIVE]        = 'Waiting';
        $retVal[self::STATUS_FAILED]        = 'Send failed';
        $retVal[self::STATUS_SUCCESS]       = 'Send success';
        return $retVal;
    }
    
    /**
     * Get array type email
     * @return Array Types
     */
    public static function getArrayType() {
        return [
            self::TYPE_ANNOUNCE            => 'Announce',
            self::TYPE_CAMPAIGN            => 'Campaign'
        ];
    }
    
    /**
     * Get type
     * @return String Type
     */
    public function getType() {
        if ((self::getArrayType()[$this->type]) != null)
        {
            return self::getArrayType()[$this->type];
        }
        return '';
    }
    
    /**
     * Get status
     * @return String Status
     */
    public function getStatus() {
        if ((self::getArrayStatus()[$this->status]) != null)
        {
            return self::getArrayStatus()[$this->status];
        }
        return '';
    }
    
    /**
     * Get sent_at
     * @return Datetime Sent at
     */
    public function getSentAt($id, $status) {
        if ($status == self::STATUS_SUCCESS)
        {   $class = CommonProcess::getClass($this);         
            return AdminRecordLog::getLastModifiedDateWithValue($class, $id, "status", $status);
        }
        return '';
    }

    /**
     * Insert auto send emails
     * @property string $subject        Subject
     * @property string $content        Content
     * @property string $sent_to        Sent to
     * @property int $type              Type
     */
    public static function insertOne($subject, $content, $sent_to, $type, $time_sent)
    {
        $email = new AdminAutoEmail();
        $email->subject            = $subject;
        $email->content            = $content;
        $email->sent_to            = $sent_to;
        $email->type               = $type;
        $email->time_sent          = $time_sent;
        $email->status             = self::STATUS_WAITING;
        $email->save();
    }
    
    /**
     * Send emails
     * @property string $subject        Subject
     * @property string $content        Content
     * @property string $sent_to        Sent to
     * 
     */
    public static function sendEmail($subject, $content, $sent_to) {
        
        $data = ['content' => $content, 'subject' => $subject];
        Mail::to($sent_to)->send(new SendEmail($data));      
        return Redirect::back(); 
    }
    
    /**
     * Send emails Announce
     * @property string $subject        Subject
     * @property string $content        Content
     * @property string $sent_to        Sent to
     * 
     */
    public static function sendEmailAnnounce($subject, $content, $sent_to, $time_sent) {
        
        self::insertOne($subject,
                $content,
                $sent_to,
                self::TYPE_ANNOUNCE, $time_sent);
       
    }
    
    /**
     * Send emails Announce
     * @property string $subject        Subject
     * @property string $content        Content
     * @property string $sent_to        Sent to
     * 
     */
    public static function sendEmailCampaign($subject, $content, $sent_to, $time_sent) {
        
        self::insertOne($subject,
                $content,
                $sent_to,
                self::TYPE_CAMPAIGN, $time_sent);       
    }
    
    /**
     * Send and update status email
     * @property int    $id_mail        Subject
     * @property string $subject        Subject
     * @property string $content        Content
     * @property string $sent_to        Sent to
     * 
     */
    public static function sendAndUpdateEmail($mail_id, $subject, $content, $sent_to) {
        
        self::sendEmail($subject, $content, $sent_to);
        $email = self::find($mail_id);
        $email->status = self::STATUS_SUCCESS;
        $email ->save();       
    }
}