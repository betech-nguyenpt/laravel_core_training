<?php

namespace Modules\Admin\Entities;

use App\Utils\CommonProcess;

/**
 * This is the model class for table "admin_modules".
 *
 * @property int $id                Id
 * @property int $ip_address        IP address
 * @property string $module         Modules
 * @property string $controller     Controllers
 * @property string $action         Actions
 * @property string $browser        Browser 
 * @property int $os                Operating System
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminChangePassRequest extends AdminModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
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
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */ 
    protected $fillable = [
        'user_id', 'code', 'ip_address', 'country', 'device', 'status', 'created_by'
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-change-pass-request-logs', ['id' => $this->id]);
    }
    
    /**
     * Get type of device
     * @return string Type of device
     */
    public function getType() {
        if (isset(self::getArrayTypes()[$this->device])) {
            return self::getArrayTypes()[$this->device];
        }
        return '';
    }
    
    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public static function getRules() {
        return [
        ];
    }
    
    /**
     * Get array of types
     * @return Array Key=>Value array
     */
    public static function getArrayTypes() {
        return [
            self::PLATFORM_ANDROID  => 'Android',
            self::PLATFORM_IOS      => 'iOS',
            self::PLATFORM_WINDOWS  => 'Windows',
            self::PLATFORM_WEB      => 'Web',
        ];
    }
    
    /**
     * Insert record
     * @param type $user_id
     */
    public static function insertOne($user_id)
    {
        $changePass = new AdminChangePassRequest();
        $ip         = CommonProcess::getUserIP();
        $changePass->user_id    = $user_id;
        $changePass->code       = CommonProcess::randString(24);
        $changePass->ip_address = $ip;
        $changePass->country    = CommonProcess::getUserCountry($ip);
        $changePass->device     = 4;
        $changePass->status     = 1;
        $changePass->save();
    }
}