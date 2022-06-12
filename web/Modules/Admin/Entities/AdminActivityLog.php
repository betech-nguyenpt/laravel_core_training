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
class AdminActivityLog extends AdminModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */ 
    protected $fillable = [
        'session', 'ip_address', 'module', 'controller', 'action', 'browser', 'os', 'created_by'
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-activity-logs', ['id' => $this->id]);
    }
    
    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public static function getRules() {
        return [];
    }
    
    /**
     * Insert record for table admin_activity_logs
     * @param string $moduleName            Name of module
     * @param string $controllerName        Name of controller
     * @param string $actionName            Name of action
     */
    public static function insert($moduleName, $controllerName, $actionName)
    {
        $activity               = new AdminActivityLog;
        $activity->session      = CommonProcess::getUserSession();
        $activity->ip_address   = CommonProcess::getUserIP();
        $activity->module       = $moduleName;
        $activity->controller   = $controllerName;
        $activity->action       = $actionName;
        $activity->browser      = CommonProcess::getBrowser();
        $activity->os           = CommonProcess::getOS();
        $activity->save();
    }
}
