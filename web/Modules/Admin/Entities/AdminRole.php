<?php

namespace Modules\Admin\Entities;

/**
 * This is the model class for table "admin_modules".
 *
 * @property int $id                Id
 * @property string $name           Name
 * @property string $code           Description
 * @property int $weight            Weight
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminRole extends AdminModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    const ROLE_SUPER_ADMIN          = '1';
    const ROLE_ADMIN                = '2';
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------

    /** Fillable array */
    protected $fillable = [
        'name', 'code', 'weight', 'status', 'created_by'
    ];

    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-roles', ['id' => $this->id]);
    }
    
    /**
     * Check if this role is SUPER ADMIN role
     * @return boolean True if id is ROLE_SUPER_ADMIN, false otherwise
     */
    public function isSuperAdminRole() {
        return ($this->id == self::ROLE_SUPER_ADMIN);
    }
    
    /**
     * Check if this role is ADMIN role
     * @return boolean True if id is ROLE_ADMIN, false otherwise
     */
    public function isAdminRole() {
        return ($this->id == self::ROLE_ADMIN);
    }

    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public static function getRules() {
        return [
            'name' => 'required',
            'code' => 'required',
            'weight' => 'required',
        ];
    }

    /**
     * Get Role Name
     *
     * @param  mixed $id
     * @return string $name
     */
    public static function getRoleName($id) {
        $models = self::find($id);
        $name = '';
        if($models)
        {
            $name = $models->name;
        }
        return $name;
    }

}
