<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Api\Entities;
use Modules\Admin\Entities\AdminUser;
use Modules\Api\Traits\AuthTrait;

/**
 * Description of ApiUser
 *
 * @author Trung
 */
class ApiUser extends AdminUser {
    use AuthTrait;
    
    protected $table = 'admin_users';
    
    /**
     * Get user info
     * @return array Information of user
     */
    public function getUserInfo() {
        return [
            'email' => $this->email,
            'name'  => $this->name,
            'role'  => $this->getRoleName(),
        ];
    }
}
