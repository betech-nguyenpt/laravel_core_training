<?php

namespace Modules\Admin\Http\Controllers;

use App\Utils\DomainConst;
use Modules\Admin\Entities\AdminPermissionRole;
use App\Utils\CommonProcess;
use Modules\Admin\Entities\AdminLogger;

class AdminRoleController extends BaseAdminController
{
    /** Class of model */
    public $modelClass      = '\Modules\Admin\Entities\AdminRole';
    /** Name of controller */
    public $controllerName  = 'admin-roles';
    
    /**
     * Grant permission for role.
     *
     * @return \Illuminate\Http\Response
     */
    public function authorization($id) {
        $model = $this->modelClass::find($id);
        $controller = $this->controllerName;
        return view($this->getModuleController() . '.authorization', compact('model', 'controller'));
    }
    
    /**
     * Grant permission for role.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission($id)
    {
        $data       = isset($_GET['data']) ? $_GET['data'] : '';
        $can_access = isset($_GET['can_access']) ? $_GET['can_access'] : '';
        $arrData = explode(DomainConst::SPLITTER_TYPE_5, $data);
        if (count($arrData) == 2) {
            $controller_id  = $arrData[0];
            $action_key     = $arrData[1];
            if ($can_access == 'true') {
                AdminLogger::info('Grant permission', 'For role - controller - action: ' . $id . '-' . $controller_id . '-' . $action_key, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
                $retVal = AdminPermissionRole::grantPermission($id, $controller_id, $action_key);
            } else {
                AdminLogger::info('Deny permission', 'For role - controller - action: ' . $id . '-' . $controller_id . '-' . $action_key, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
                $retVal = AdminPermissionRole::denyPermission($id, $controller_id, $action_key);
            }
            if ($retVal) {
                return [
                    'status'    => DomainConst::NUMBER_ONE_VALUE,
                ];
            }
            
        }
        return [
            'status'    => DomainConst::NUMBER_ZERO_VALUE,
        ];
    }
    
    /**
     * Grant permission for role (1 controller).
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionAll($id)
    {
        $controller_id  = CommonProcess::getValue($_GET, 'controller_id');
        $can_access     = CommonProcess::getValue($_GET, 'can_access');
        if ($can_access == 'true') {
            AdminLogger::info('Grant permission', 'For role - controller: ' . $id . '-' . $controller_id, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            $retVal = AdminPermissionRole::grantPermissionForController($id, $controller_id);
        } else {
            AdminLogger::info('Deny permission', 'For role - controller: ' . $id . '-' . $controller_id, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            $retVal = AdminPermissionRole::denyPermissionForController($id, $controller_id);
        }
        if ($retVal) {
            return [
                'status'    => DomainConst::NUMBER_ONE_VALUE,
            ];
        }
        return [
            'status'    => DomainConst::NUMBER_ZERO_VALUE,
        ];
    }
}
