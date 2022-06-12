<?php

namespace Modules\Admin\Entities;

use App\Utils\DomainConst;
use App\Entities\RootModel;

/**
 * This is the model class for table "admin_permission_users".
 *
 * @property int $id                            Id
 * @property int $user_id                       User ID
 * @property int $controller_id                 Controller ID
 * @property string $actions                    Actions
 * @property int $can_access                    Can Access
 * @property string $created_at                 Created date
 * @property string $updated_at                 Updated date
 */
class AdminPermissionUser extends RootModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'user_id', 'controller_id', 'actions', 'can_access'
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
     * @param int $user_id                       User ID
     * @param int $controller_id                 Controller ID
     * @param string $actions                    Actions
     * @param int $can_access                    Can Access
     */
    public static function insertOne($user_id, $controller_id, $actions, $can_access)
    {
        $model = new AdminPermissionUser();
        $model->user_id         = $user_id;
        $model->controller_id   = $controller_id;
        $model->actions         = $actions;
        $model->can_access      = $can_access;
        $model->save();
    }
    
    /**
     * Get Action User
     * @param int $user_id              Role ID
     * @param int $controller_id                 Controller ID
     */
    public static function getCanAccess($user_id, $controller_id,$actions)
    {
        $permissionUser = self::where([
            'user_id'           => $user_id,
            'controller_id'     => $controller_id,
        ])
        ->first();
        if (isset($permissionUser)){
            $arrayActions = explode(DomainConst::SPLITTER_TYPE_2, $permissionUser->actions);
            return in_array($actions, $arrayActions);
        }
        return false;
    }
    
    /**
     * Save permission
     * @param Array $post Post array
     * @param String $role_id Id of role
     * @param String $controller_id Id of controller
     */
    public static function savePermission($post, $user_id = '', $controller_id = '') {
        $allow_actions  = [];
        $deny_actions   = [];
        // Stop when user and controller empty
        if (empty($post) || empty($user_id) || empty($controller_id)) {
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
            'user_id'       => $user_id,
            'can_access'    => DomainConst::DEFAULT_ACCESS_ALLOW,
        ])->first();
        $denyModel = self::where([
            'controller_id' => $controller_id,
            'user_id'       => $user_id,
            'can_access'    => DomainConst::DEFAULT_ACCESS_DENY,
        ])->first();
        $strAllowActions = implode(DomainConst::SPLITTER_TYPE_2, $allow_actions);
        $strDenyActions = implode(DomainConst::SPLITTER_TYPE_2, $deny_actions);
        if ($allowModel) {
            $allowModel->actions = $strAllowActions;
            $allowModel->save();
        } else {
            self::insertOne($user_id, $controller_id, $strAllowActions, DomainConst::DEFAULT_ACCESS_ALLOW);
        }
        if ($denyModel) {
            $denyModel->actions = $strDenyActions;
            $denyModel->save();
        } else {
            self::insertOne($user_id, $controller_id, $strDenyActions, DomainConst::DEFAULT_ACCESS_DENY);
        }
    }
}
