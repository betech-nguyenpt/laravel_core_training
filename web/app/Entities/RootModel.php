<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\AdminLogger;

/**
 * This is the base model class.
 *
 * @property int $id                Id
 *
 * @author nguyenpt <nguyenpt@bisync.jp>
 */
class RootModel extends Model
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'id',
    ];
    
    //-----------------------------------------------------
    // Parent methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function save(array $options = array()) {
        $retVal = parent::save($options);
        if (!$retVal) {
            if ($this->exists) {
                AdminLogger::updateModelFailed($this, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            } else {
                AdminLogger::createModelFailed($this, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            }
        }
                
        return $retVal;
    }
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * Get show link of model
     * @return string Show link of model
     */
    public function getShowLink() {
        return '';
    }
    
    /**
     * Get show link with "<a>" tag
     * @param string $field Name of field
     * @return string Html string
     */
    public function getShowLinkTag($field = 'name') {
        return '<a href="' . $this->getShowLink() . '">' . $this->$field . '</a>';
    }
    
    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * Get rules validate model
     * @return Array
     */
    public static function getRules()
    {
        return [];
    }
    
    /**
     * Load list items as select array
     * @param string $field         Name of field
     * @param bool $emptyOption     True if need empty option, false otherwise
     * @return array Key=>Value array
     */
    public static function loadItemsAsSelectArray($field = 'name', $emptyOption = false) {
        $retVal = [];
        $models = self::all();
        if ($emptyOption) {
            $retVal['0'] = 'Select';
        }
        foreach ($models as $model) {
            $retVal[$model->id] = $model->$field;
        }
        return $retVal;
    }

    /**
     * Find one record
     * 
     * @param array $whereParamenters    Paramenter where in sql
     * @return null|Obj
     */
    public static function findOne($whereParamenters)
    {
        return self::where($whereParamenters)->first();
    }
}
