<?php

namespace Modules\Api\Entities;

use App\Utils\CommonProcess;
use Modules\Admin\Entities\AdminUser;
use App\SMS\NexmoService;
use Modules\Admin\Entities\AdminLogger;
use Mail;
use Redirect;
use App\Mail\SendEmail;

/**
 * This is the model class for table "api_reg_requests".
 *
 * @property int $id                Id
 * @property string $phone          Phone
 * @property string $code           Code
 * @property string $time_verify    Time Verify
 * @property string $password       Password hash
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class ApiRegRequest extends ApiModel
{
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    //-----------------------------------------------------
    const STATUS_INACTIVE        = '0';
    /** Status inactive */
    const STATUS_ACTIVE          = '1';
    /** Status verified */
    const STATUS_VERIFIED        = '2';
    /** Status timeuout */
    const STATUS_TIMEOUT         = '3';
    /** Fillable array */
    protected $fillable = [
        'phone', 'code', 'time_verify', 'status', 'created_by',
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('api/api-reg-requests', ['id' => $this->id]);
    }
    
    /**
     * Get status of user 
     * @return string
     */
    public function getStatus() 
    {
        if (isset(self::getArrayStatus()[$this->status])){
            return self::getArrayStatus()[$this->status];
        }
        return '';
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
        ];
    }
    
    /**
     * Get array of status
     * @return Array Key=>Value array
     */
    public static function getArrayStatus()
    {
        return[
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE   => 'Active',
            self::STATUS_TIMEOUT  => 'Timeout',
            self::STATUS_VERIFIED => 'Verified',
        ];
    }
    
    /**
     * Insert record
     * @param String $phone Phone number
     * @return \app\modules\api\models\ApiRegRequests
     */
    public static function insertOne($phone, $password) 
    {
        $model = new ApiRegRequest();
        $model->phone           = $phone;
//        $model->code            = CommonProcess::randString(
//                AdminSettings::getOtpLength(),
//                '0123456789');
        $model->code = CommonProcess::randString(6, '0123456789');
        $model->time_verify = '';
        if (!$model->save()) 
        {
            AdminLoggers::createModelFailed($model,
                    __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            return null;
        } 
        else 
        {
            if (CommonProcess::isPhone($phone)) {
                  NexmoService::sendSMS($phone, $model->code);
            } else {
                  $content = 'Your OTP code is: '.$model->code;
                  $data = ['content' => $content, 'subject' => 'OTP code'];
                  Mail::to($phone)->send(new SendEmail($data)); 
            }
        }
        return $model;
    }
    
    /**
     * Validate otp
     * @param String $phone Phone number
     * @param String $code OTP code
     * @return ApiRegRequest Model if found in db
     */
    public static function verifyOTP($phone, $code) 
    {
        $model = self::where([
            'phone' => $phone,
            'code'  => $code,
        ])->first();
        if ($model) 
        {
            $currentTime =date("Y-m-d H:i:sa");
            $createdTime = $model->created_at;
            $timeFirst   = strtotime($currentTime);
            $timeSecond  = strtotime($createdTime);
            $diff = $timeFirst - $timeSecond;
            if ($diff <= 120) 
            {
                $model->status      = self::STATUS_VERIFIED;
                $model->time_verify = $currentTime;
                if (!$model->save()) 
                {
                    AdminLoggers::updateModelFailed($model,
                            __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
                    return null;
                }
                return $model;
            } 
            else 
            {
                $model->status = self::STATUS_TIMEOUT;
                if (!$model->save()) 
                {
                    AdminLoggers::updateModelFailed($model,
                            __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
                    return null;
                }
            }
        }
        return null;
    }
}
