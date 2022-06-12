<?php

namespace Modules\Admin\Entities;

use App\Utils\CommonProcess;
use Modules\Admin\Entities\AdminLogger;

/**
 * This is the model class for table "admin_record_logs".
 *
 * @property int $id                Id
 * @property string $description    Description
 * @property string $action         Action
 * @property string $model          Model
 * @property int $model_id          Model ID
 * @property string $field          Field change
 * @property string $old_value      Old value
 * @property string $new_value      New value
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminRecordLog extends AdminModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    const ACTION_INSERT = 'CREATE';
    const ACTION_UPDATE = 'CHANGE';
    const ACTION_DELETE = 'DELETE';

    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'description', 'action', 'model', 'model_id', 'field', 'old_value', 'new_value', 'status', 'created_by'
    ];

    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('admin/admin-record-logs', ['id' => $this->id]);
    }

    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public static function getRules()
    {
        return [];
    }

    /**
     * Insert record
     * @param String $description   Description
     * @param String $action        Action
     * @param String $model         Model
     * @param String $model_id      Model ID
     * @param String $field         Field change
     * @param String $old_value     Old value
     * @param String $new_value     New value
     */
    public static function insertOne($description, $action, $model, $model_id,
            $field, $old_value, $new_value)
    {
        $mRecord = new AdminRecordLog();
        $mRecord->description     = $description;
        $mRecord->action          = $action;
        $mRecord->model           = $model;
        $mRecord->model_id        = $model_id;
        $mRecord->field           = $field;
        $mRecord->old_value       = $old_value;
        $mRecord->new_value       = $new_value;
        $mRecord->save();
    }

    /**
     * Insert record logs
     * @param String $username      User create model
     * @param String $model         Model
     */
    public static function insertRecord($username, $model) {
        $class = CommonProcess::getClass($model);
        $description = 'User <strong>' . $username . '</strong> created <strong>' . $class . '</strong> model';
        self::insertOne($description,
                self::ACTION_INSERT,
                $class, $model->id, '', '', '');
    }

    /**
     * Update record logs
     * @param String $username      User create model
     * @param String $model         Model
     * @param String $model         Model
     * @param String $model_id      Model ID
     * @param String $field         Field change
     * @param String $old_value     Old value
     * @param String $new_value     New value
     */
    public static function updateRecord($username, $model, $field, $old_value) {
        $class = CommonProcess::getClass($model);
        $description = 'User <strong>' . $username . '</strong> changed value in the <strong>' . $class . '</strong> model';
        self::insertOne($description,
                self::ACTION_UPDATE,
                $class, $model->id,
                $field, $old_value,
                $model->$field);
    }

    /**
     * Delete record logs
     * @param String $description   Description
     * @param String $model         Model
     * @param String $model_id      Model ID
     */
    public static function deleteRecord($username, $model) {
        $class = CommonProcess::getClass($model);
        $description = 'User <strong>' . $username . '</strong> deleted <strong>' . $class . '</strong> model';
        self::insertOne($description,
                self::ACTION_DELETE,
                $class, $model->id, '', '', '');
    }
    
    
    /**
     * Get last modified record by Class and Fied
     * @param  String $class     Class of model
     * @param  String $id        Id of model
     * @param  String $field     Field of model
     * @param  String $value     Value of field
     * @return AdminRecordLogs  Record log model
     */
    public static function getLastModifiedValue($class, $id, $field, $value) {
        return self::where  ('model'    , '=', $class)
                   ->where  ('model_id' , '=', $id)
                   ->where  ('field'    , '=', $field)
                   ->where  ('new_value', '=', $value)
                   ->orderBy('id'       , 'DESC')
                   ->first();
        
    }
    
    /**
     * Get last modified date
     * @param  String $obj       Class of model
     * @param  String $id        Id of object
     * @param  String $field     Field of model
     * @param  String $value     Value of field
     * @return String Last modified date
     */
    public static function getLastModifiedDateWithValue($class, $id, $field, $value) {
        $model = self::getLastModifiedValue($class, $id, $field, $value);
        if ($model) {
            return $model->created_at;
        }        
        return '';
    }
    
}
