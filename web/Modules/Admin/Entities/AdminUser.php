<?php

namespace Modules\Admin\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Hash;
/**
 * This is the model class for table "admin_users".
 *
 * @property int $id                Id
 * @property string $username       Username
 * @property string $email          Email
 * @property string $email_verified_at  Time verified email
 * @property string $name           Name
 * @property string $password       Password
 * @property string $remember_token Remember token
 * @property int $role_id           Id of role
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminUser extends AdminModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    // Status
    //-----------------------------------------------------
    /** Status registering */
    const STATUS_REGISTERING  = '2';
    /** Fillable array */
    protected $fillable = [
        'username', 'email', 'email_verified_at', 'name', 'password', 'remember_token', 'role_id', 'status', 'created_by'
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-users', ['id' => $this->id]);
    }
    
    /**
     * Get AdminRole object
     * @return AdminRole Model
     */
    public function getRole() {
        return AdminRole::find($this->role_id);
    }
    
    /**
     * Get role link
     * @return string Html string
     */
    public function getRoleLink() {
        $mRole = $this->getRole();
        if ($mRole) {
            return $mRole->getShowLinkTag();
        }
        return '';
    }
    
    /**
     * Get role name
     * @return string Name of role
     */
    public function getRoleName() {
        $mRole = $this->getRole();
        if ($mRole) {
            return $mRole->name;
        }
        return '';
    }
    
    /**
     * Check if user is Super Admin
     * @return boolean True if user is Super Admin, false otherwise
     */
    public function isSuperAdmin() {
        $mRole = $this->getRole();
        if ($mRole) {
            return $mRole->isSuperAdminRole();
        }
        return false;
    }
    
    /**
     * Validate login information
     * @param string $password Password
     * @return boolean
     */
    public function validateLogin($password) {
        if (Hash::check($password, $this->password)) {
            return true;
        }
        return false;
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
            'username'      => 'required',
            'password'      => 'required',
            'email'         => 'required',
            'role_id'       => 'required',
        ];
    }
}
