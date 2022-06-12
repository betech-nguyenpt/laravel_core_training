<?php

namespace App\Entities;

use Illuminate\Support\Facades\Auth;
use Modules\Admin\Entities\AdminLogger;

/**
 * This is the base model class.
 *
 * @property int $id                Id
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class BaseModel extends RootModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    const STATUS_INACTIVE           = '0';
    const STATUS_ACTIVE             = '1';
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'id', 'status', 'created_by', 'created_at', 'updated_at'
    ];
    
    //-----------------------------------------------------
    // Parent methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function save(array $options = array()) {
        if (empty($this->created_by) && Auth::check()) {
            $this->created_by = Auth::user()->id;
        }
                
        return parent::save($options);
    }
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    
    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * Get all models
     * @return BaseModel List all models
     */
    public static function loadItems() {
        return self::where('status', '<>', self::STATUS_INACTIVE)
                    ->get();
    }
    
    /**
     * Get array status
     * @return Array Status
     */
    public static function getArrayStatus() {
        return [
            self::STATUS_ACTIVE           => 'Active',
            self::STATUS_INACTIVE          => 'Inactive',
        ];
    }
    
    /**
     * Find model by name attribute
     * @param string $name Name value
     * @return BaseModel Model object
     */
    public static function getByName($name) {
        return self::where('name', $name)
                ->where('status', '!=', \App\Utils\DomainConst::DEFAULT_STATUS_INACTIVE)->first();
    }
    
    /**
     * Find model by id attribute
     * @param string $id    Id of model
     * @return BaseModel Model object
     */
    public static function getById($id) {
        return self::where('id', $id)
                ->where('status', '!=', \App\Utils\DomainConst::DEFAULT_STATUS_INACTIVE)->first();
    }

    /**
     * Find one record where status != 0
     * 
     * @param array $whereParamenters    Paramenter where in sql
     * @return null|Obj
     */
    public static function findOne($whereParamenters)
    {
        return self::where($whereParamenters)->where('status', '<>', self::STATUS_INACTIVE)->first();
    }
}
