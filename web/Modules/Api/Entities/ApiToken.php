<?php

namespace Modules\Api\Entities;

use App\Utils\CommonProcess;
use Modules\Admin\Entities\AdminUser;

/**
 * This is the model class for table "api_tokens".
 *
 * @property int $id                Id
 * @property string $devices        Devices
 * @property string $user_id        User Id
 * @property string $user_token     User token
 * @property string $device_token   Device token
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class ApiToken extends ApiModel
{
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    // Platform
    //-----------------------------------------------------
    /** Platform android */
    const PLATFORM_ANDROID      = '1';
    /** Platform ios */
    const PLATFORM_IOS          = '2';
    /** Platform Windows */
    const PLATFORM_WINDOWS      = '3';
    /** Platform Web */
    const PLATFORM_WEB          = '4';
    // Status
    //-----------------------------------------------------
    /** Status active */
    const STATUS_INACTIVE       = '0';
    /** Status inactive */
    const STATUS_ACTIVE         = '1';
    /** Status logout */
    const STATUS_LOGOUT         = '2';
    /** Fillable array */
    protected $fillable = [
        'type', 'user_id', 'token', 'device_token', 'status', 'created_by',
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('api/api-tokens', ['id' => $this->id]);
    }
    
    /**
     * Get type of device
     * @return string Type of device
     */
    public function getType() 
    {
        if (isset(self::getArrayTypes()[$this->type])) {
            return self::getArrayTypes()[$this->type];
        }
        return '';
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
            self::STATUS_LOGOUT   => 'Logout',
        ];
    }
    
    /**
     * Get array of types
     * @return Array Key=>Value array
     */
    public static function getArrayTypes() 
    {
        return [
            self::PLATFORM_ANDROID  => 'Android',
            self::PLATFORM_IOS      => 'iOS',
            self::PLATFORM_WINDOWS  => 'Windows',
            self::PLATFORM_WEB      => 'Web',
        ];
    }
    
    /**
     * Find user model
     * @param type $arr
     * @return type
     */
    public static function findOne($arr)
    {
        return self::where($arr)->first();
    }
    
    /**
     * Get model user by token
     * @param String $token Token value
     * @return ApiUsers Model
     */
    public static function findUserByToken($token) 
    {
        $tokenVal = trim($token);
        if (empty($tokenVal)) {
            return null;
        }
        $model = self::findOne([
            'token'     => $token,
            'status'    => self::STATUS_ACTIVE,
        ]);
        if ($model) {
            return $model->user;
        }
        return null;
    }
    
    /**
     * Find user token model by id
     * @param String $user_id Id of user
     * @return ApiUserTokens Model user token
     */
    public static function findUserTokenModelById($user_id) 
    {
        $model = self::where([
            'user_id'   => $user_id,
        ])->where ('satus', '!=', self::STATUS_INACTIVE )
          ->first();
        if ($model) {
            AdminLoggers::info('Found user with token',
                    $model->token, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            return $model;
        }
        return null;
    }
    
    /**
     * Logout
     * @param String $token Token value
     */
    public static function logout($token) 
    {
        $model = self::findOne(['token' => $token]);
        if ($model) {
            $model->status = self::STATUS_LOGOUT;
            if (!$model->save()) {
                AdminLoggers::updateModelFailed($model, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            }
        }
    }
    
    /**
     * Delete all tokens
     * @param String $token Token value
     */
    public static function deleteTokens($token) 
    {
        $model = self::findOne(['token' => $token]);
        if ($model) {
            $model->status = self::STATUS_INACTIVE;
            if (!$model->save()) {
                AdminLoggers::updateModelFailed($model, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            }
        }
    }
    
    /**
     * Check model does exist
     * @param String $user_id           Id of user
     * @param String $type              Type of platform
     * @param String $device_token      Device token
     * @return boolean Model if found, False otherwise
     */
    public static function checkExist($user_id, $type, $device_token) 
    {
        $model = self::findOne([
            'user_id'       => $user_id,
            'type'          => $type,
            'device_token'  => $device_token,
            'status'        => self::STATUS_ACTIVE,
        ]);
        if ($model) {
            return $model;
        }
        return false;
    }
    
     /**
     * Create new model
     * @param String $user_id           Id of user
     * @param String $type              Type of platform
     * @param String $device_token      Device token
     * @param String $token             Current token
     */
    public static function insertOne($user_id, $type, $device_token, $token = '') 
    {
        $oldModel = self::checkExist($user_id, $type, $device_token);
        if ($oldModel) {
            $oldModel->status = self::STATUS_INACTIVE;
            if (!$oldModel->save()) {
                AdminLoggers::updateModelFailed($oldModel, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            }
            
        }
        $model              = new ApiToken;
        $model->type        = $type;
        $model->user_id     = $user_id;
        $model->token  = $token;
        if (empty($token)) {
            $model->token = CommonProcess::generateSessionId(); 
        }        
        $model->device_token = $device_token;
        if (!$model->save()) {
            AdminLoggers::createModelFailed($model, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            return null;
        }
        return $model;
    }
    
    /**
     * Find device token
     * @param String $user_id Id of user
     * @param String $type Type of device
     * @return string Device token
     */
    public static function findDeviceToken($user_id, $type) 
    {
        $model = self::findOne([
            'user_id'   => $user_id,
            'type'      => $type,
        ]);
        if ($model) {
            return $model->device_token;
        }
        return '';
    }
}
