<?php

namespace Modules\Admin\Entities;

use Modules\Admin\Entities\AdminPermissionRole;

/**
 * This is the model class for table "admin_actions".
 *
 * @property int $id                Id
 * @property int $controller_id     Id of controller belongs to
 * @property string $name           Name
 * @property string $key            Key of action (index/create/show)
 * @property int $permission        Permission (1-Private, 2-Protected, 3-Public)
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminAction extends AdminModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    /** Private: action only can access if user/role was assign */
    const PERMISSION_PRIVATE        = '1';
    /** Protected: action can access by all users was logged */
    const PERMISSION_PROTECTED      = '2';
    /** Public: action can access by any user (include guest) */
    const PERMISSION_PUBLIC         = '3';
    
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'name', 'controller_id', 'key', 'permission', 'status', 'created_by'
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-actions', ['id' => $this->id]);
    }
    
    /**
     * Get controller name
     * @return AdminController AdminController model
     */
    public function getController() {
        return AdminController::find($this->controller_id);
    }
    
    /**
     * Get link to controller show
     * @return string Html string
     */
    public function getControllerLink() {
        $mController = $this->getController();
        if ($mController) {
            return $mController->getShowLinkTag('name');
        }
        return '';
    }

    /**
     * Get permission string
     * @return string Permission as string
     */
    public function getPermissionValue() {
        if (isset(self::getArrayPermission()[$this->permission])) {
            return self::getArrayPermission()[$this->permission];
        }
        return '';
    }
    
    /**
     * Get permission as html format
     * @return string Permission as html format
     */
    public function getPermission() {
        if (isset(self::getArrayPermission()[$this->permission])) {
            $permission = self::getArrayPermission()[$this->permission];
            switch ($this->permission) {
                case self::PERMISSION_PRIVATE:
                    return '<span class="badge badge-danger">' . $permission . '</span>';
                case self::PERMISSION_PROTECTED:
                    return '<span class="badge badge-warning">' . $permission . '</span>';
                case self::PERMISSION_PUBLIC:
                    return '<span class="badge badge-success">' . $permission . '</span>';

                default:
                    break;
            }
            return;
        }
        return '';
    }
    
    /**
     * Get full name of action (use for authorization)
     * @return string Name of action (Module - Controller - Action)
     */
    public function getFullname() {
        $mController = $this->getController();
        if ($mController) {
            $mModule = $mController->getModule();
            if ($mModule) {
                return $mModule->name . $mController->name . $this->key;
            }
        }
        return '';
    }
    
    /**
     * Check user can access
     * @param AdminUser $user User model
     * @return boolean True if user can access, false otherwise
     */
    public function canAccess($user) {
        if ($user->isSuperAdmin()) {
            return true;
        }
        if ($this->isPublic()) {
            return true;
        }
        $mRole = $user->getRole();
        $mController = $this->getController();
        if ($mRole && $mController) {
            return AdminPermissionRole::canAccess($mRole->id, $mController->id, $this->key);
        }
        return false;
    }
    
    /**
     * Check if permission of action is PUBLIC
     * @return bool True if permission of action is PUBLIC, false otherwise
     */
    public function isPublic() {
        return ($this->permission == self::PERMISSION_PUBLIC);
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
            'name'          => 'required',
            'key'           => 'required',
            'controller_id' => 'required',
            'permission'    => 'required',
        ];
    }
    
    /**
     * Get array permission
     * @return Array Key=>Value array
     */
    public static function getArrayPermission() {
        return [
            self::PERMISSION_PRIVATE    => 'Private',
            self::PERMISSION_PROTECTED  => 'Protected',
            self::PERMISSION_PUBLIC     => 'Public',
        ];
    }
    
    /**
     * Find action by full name
     * @param string $controller    Name of controlle
     * @param typstringe $key       Key of action
     * @return AdminAction  Action model
     */
    public static function getByFullname($controller, $key) {
        $mController = AdminController::getByName($controller);
        if ($mController) {
            return self::where('controller_id', $mController->id)
                    ->where('key', $key)
                    ->first();
        }
        return null;
    }
}
