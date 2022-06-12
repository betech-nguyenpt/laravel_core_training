<?php

namespace Modules\Admin\Entities;

use App\Entities\RootModel;

/**
 * This is the model class for table "admin_one_many".
 *
 * @property int $id                    Id
 * @property int $one_id                One id
 * @property int $many_id               Many id
 * @property int $type                  Type

 */
class AdminOneMany extends RootModel
{
    public $timestamps = false;

    protected $table = 'admin_one_many';
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'admin_one_many';
    }

    //-----------------------------------------------------
    // Type of relation
    //-----------------------------------------------------
    /** 1 [AdminUsers] has many [AdminRoles] as sub_role */
    const TYPE_USER_ROLE_SUB                    = '1';

    /** 1 [AdminNotification] has many [AdminUser] as 'Users were read Notification' */
    const TYPE_NOTIFICATION_USER                  = '2';

    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'one_id', 'many_id', 'type',
    ];

    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('admin/admin_one_many', ['id' => $this->id]);
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
            'one_id' => 'required',
            'many_id' => 'required',
            'type' => 'required',
            'one_id' => 'integer',
            'many_id' => 'integer',
            'type' => 'integer',
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id'        => 'Id',
            'one_id'    => 'One id',
            'many_id'   => 'Many id',
            'type'      => 'Type of relation',
        ];
    }

    //-----------------------------------------------------
    // Override methods
    //-----------------------------------------------------
    public function beforeSave($insert) {
        return true;
    }

    //-----------------------------------------------------
    // Declare of relations
    //-----------------------------------------------------



    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * Get type of relation
     * @return string Type of relation
     */
    public function getTypeRelation() {
        if (isset(self::getArrayRelations()[$this->type])) {
            return self::getArrayRelations()[$this->type];
        }
        return '';
    }

    /**
     * Get one_id model view url
     * @return String Html string
     */
    public function getOneViewUrl() {
        $retVal = '';
        $name = '';
        switch ($this->type) {
            case self::TYPE_USER_ROLE_SUB:
                $retVal = isset($this->user) ? $this->user->getViewLink() : '';
                $name = isset($this->user) ? $this->user->fullname : '';
                break;
            default:
                break;
        }
        return '<a href="' . $retVal . '">' . $name . '</a>';
    }

    /**
     * Get many_id model view url
     * @return String Html string
     */
    public function getManyViewUrl() {
        $retVal = '';
        $name = '';
        switch ($this->type) {
            case self::TYPE_USER_ROLE_SUB:
                $retVal = isset($this->roleMany) ? $this->roleMany->getViewLink() : '';
                $name = isset($this->roleMany) ? $this->roleMany->name : '';
                break;
            default:
                break;
        }
        return '<a href="' . $retVal . '">' . $name . '</a>';
    }

    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * Check data does exist
     * @param Int $one_id   One id
     * @param Int $many_id  Many id
     * @param Int $type  Type of relation
     * @return boolean True if data does exist, false otherwise
     */
    public static function checkExist($one_id, $many_id, $type) {
        $model = self::findOne([
            'one_id'    => $one_id,
            'many_id'   => $many_id,
            'type'      => $type,
        ]);
        if ($model) {
            return true;
        }
        return false;
    }

    /**
     * Insert new record
     * @param Int $one_id   One id
     * @param Int $many_id  Many id
     * @param Int $type  Type of relation
     * @return AdminOneMany Object after insert success, null otherwise
     */
    public static function insertOne($one_id, $many_id, $type) {
        if (self::checkExist($one_id, $many_id, $type)) {
            return null;
        }
        $model              = new AdminOneMany();
        $model->one_id      = $one_id;
        $model->many_id     = $many_id;
        $model->type        = $type;
        if (!$model->save()) {
            AdminLogger::createModelFailed($model, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
        } else {
            return $model;
        }

        return null;
    }

    /**
     * Insert many array
     * @param Int $one_id       One id
     * @param Int $arrMany_id   Array of Many id
     * @param Int $type      Type of relation
     */
    public static function insertMany($one_id, $arrMany_id, $type) {
        if (is_array($arrMany_id)) {
            foreach ($arrMany_id as $many_id) {
                self::insertOne($one_id, $many_id, $type);
            }
        }
    }

    /**
     * Delete a record
     * @param Int $one_id   One id
     * @param Int $many_id  Many id
     * @param Int $type     Type of relation
     */
    public static function deleteOne($one_id, $many_id, $type) {
        $model = self::findOne([
            'one_id'    => $one_id,
            'many_id'   => $many_id,
            'type'      => $type,
        ]);
        if ($model) {
            $model->delete();
        }
    }

    /**
     * Delete all old records
     * @param Int $one_id   One id
     * @param Int $type     Type of relation
     */
    public static function deleteAllOldRecords($one_id, $type) {
        if (empty($one_id)) {
            return;
        }
        self::deleteAll([
            'one_id'    => $one_id,
            'type'      => $type,
        ]);
    }
    /**
     * Delete all many old records
     * @param Int $many_id  Many id
     * @param Int $type     Type of relation
     */
    public static function deleteAllManyOldRecords($many_id, $type) {
        if (empty($many_id)) {
            return;
        }
        self::deleteAll([
            'many_id'   => $many_id,
            'type'      => $type,
        ]);
    }
}
