<?php

namespace Modules\Admin\Entities;

use App\Utils\DomainConst;
use App\Entities\RootModel;

/**
 * This is the model class for table "admin_permission_roles".
 *
 * @property int $id                            Id
 * @property smallInteger $role_id              Role ID
 * @property int $controller_id                 Controller ID
 * @property string $actions                    Actions
 * @property string $created_at                 Created date
 * @property string $updated_at                 Updated date
 */
class AdminPermissionRole extends RootModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'role_id', 'controller_id', 'actions'
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    
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
     * Insert record
     * @param smallInteger $role_id              Role ID
     * @param int $controller_id                 Controller ID
     * @param string $actions                    Actions
     * @return bool 
     */
    public static function insertOne($role_id, $controller_id, $actions)
    {
        $model = new AdminPermissionRole();
        $model->role_id         = $role_id;
        $model->controller_id   = $controller_id;
        $model->actions         = $actions;
        return $model->save();
    }
    
    /**
     * Get Permission-Role
     * @param int $role_id                      Role ID
     * @param int $controller_id                Controller ID
     */
    public static function getPermissionRole($role_id, $controller_id)
    {
        return self::where([
            'role_id'           => $role_id,
            'controller_id'     => $controller_id,
        ])->first();
    }
    
    /**
     * Save permission
     * @param Array $post Post array
     * @param String $role_id Id of role
     * @param String $controller_id Id of controller
     */
    public static function savePermission($post, $role_id = '', $controller_id = '')
    {
        $allow_actions  = [];
        $deny_actions   = [];
        // Stop when role and controller empty
        if (empty($post) || empty($role_id) || empty($controller_id)) {
            return;
        }
        foreach ($post as $key => $value) {
            if ($value == DomainConst::DEFAULT_ACCESS_ALLOW) {
                $allow_actions[] = $key;
            }
            if ($value == DomainConst::DEFAULT_ACCESS_DENY) {
                $deny_actions[] = $key;
            }
        }
        
        $allowModel = self::where([
            'controller_id' => $controller_id,
            'role_id'       => $role_id,
        ])->first();
        $strAllowActions = implode(DomainConst::SPLITTER_TYPE_2, $allow_actions);
        if ($allowModel) {
            $allowModel->actions = $strAllowActions;
            $allowModel->save();
        } else {
            self::insertOne($role_id, $controller_id, $strAllowActions);
        }
    }
    
    /**
     * Grant permission for action
     * @param string $role_id           Id of role
     * @param string $controller_id     Id of controller
     * @param string $action_key        Key of action
     * @return boolean True if save success, false otherwise
     */
    public static function grantPermission($role_id, $controller_id, $action_key)
    {
        $model = self::getPermissionRole($role_id, $controller_id);
        if ($model) {
            $arrActions = explode(DomainConst::SPLITTER_TYPE_2, $model->actions);
            if (!in_array($action_key, $arrActions)) {
                $arrActions[] = $action_key;
                $model->actions = implode(DomainConst::SPLITTER_TYPE_2, $arrActions);
                return $model->save();
            }
        } else {
            return self::insertOne($role_id, $controller_id, $action_key);
        }
        return false;
    }
    
    /**
     * Grant permission for actions (in 1 controller)
     * @param string $role_id           Id of role
     * @param string $controller_id     Id of controller
     * @return boolean True if save success, false otherwise
     */
    public static function grantPermissionForController($role_id, $controller_id)
    {
        $arrActions = [];
        $arrActionsStr = [];
        $mController = AdminController::getById($controller_id);
        if ($mController) {
            $arrActions = $mController->getListActions();
            AdminLogger::info('Array actions', count($arrActions), __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            foreach ($arrActions as $value) {
                $arrActionsStr[] = $value->key;
            }
        }
        $model = self::getPermissionRole($role_id, $controller_id);
        if ($model) {
            $model->actions = implode(DomainConst::SPLITTER_TYPE_2, $arrActionsStr);
            return $model->save();
        } else {
            return self::insertOne($role_id, $controller_id, implode(DomainConst::SPLITTER_TYPE_2, $arrActionsStr));
        }
        return false;
    }
    
    /**
     * Deny permission for action
     * @param string $role_id           Id of role
     * @param string $controller_id     Id of controller
     * @param string $action_key        Key of action
     */
    public static function denyPermission($role_id, $controller_id, $action_key)
    {
        $model = self::getPermissionRole($role_id, $controller_id);
        if ($model) {
            $arrActions = explode(DomainConst::SPLITTER_TYPE_2, $model->actions);
            if (in_array($action_key, $arrActions)) {
                $newArrActions = [];
                foreach ($arrActions as $value) {
                    if ($value != $action_key) {
                        $newArrActions[] = $value;
                    }
                }
                $model->actions = implode(DomainConst::SPLITTER_TYPE_2, $newArrActions);
                $model->save();
            }
        }
    }
    
    /**
     * Deny permission for actions (in 1 controller)
     * @param string $role_id           Id of role
     * @param string $controller_id     Id of controller
     * @return boolean True if save success, false otherwise
     */
    public static function denyPermissionForController($role_id, $controller_id)
    {
        $model = self::getPermissionRole($role_id, $controller_id);
        if ($model) {
            return $model->delete();
        }
        return true;
    }
    
    /**
     * Check action can access (by role)
     * @param string $role_id           Id of role
     * @param string $controller_id     Id of controller
     * @param string $action_key        Key of action
     * @return boolean True if action can access, False otherwise
     */
    public static function canAccess($role_id, $controller_id, $action_key)
    {
        $model = self::where([
            'role_id'       => $role_id,
            'controller_id' => $controller_id,
        ])->first();
        if ($model) {
            $arrActions = explode(DomainConst::SPLITTER_TYPE_2, $model->actions);
            return in_array($action_key, $arrActions);
        }
        return false;
    }
}
