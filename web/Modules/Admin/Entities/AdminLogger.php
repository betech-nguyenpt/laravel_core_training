<?php

namespace Modules\Admin\Entities;

use App\Utils\CommonProcess;
use App\Entities\BaseModel;

/**
 * This is the model class for table "admin_loggers".
 *
 * @property int $id                Id
 * @property string $ip_address     IP address
 * @property string $country        Country
 * @property string $message        Message
 * @property string $description    Description
 * @property int $level             Level
 * @property int $logtime           Log time
 * @property string $category       Category
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminLogger extends AdminModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    const LOG_LEVEL_INFO            = '0';
    const LOG_LEVEL_WARNING         = '1';
    const LOG_LEVEL_ERROR           = '2';
    const LOG_LEVELS = [
        self::LOG_LEVEL_INFO    => 'Info',
        self::LOG_LEVEL_WARNING => 'Warning',
        self::LOG_LEVEL_ERROR   => 'Error'
    ];
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'ip_address', 'country ', 'message', 'description', 'level', 'logtime ', 'category', 'status', 'created_by'
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('admin/admin-loggers', ['id' => $this->id]);
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
            'ip_address'             => 'required',
            'country'               => 'required',
            'message'               => 'required',
            'description'           => 'required',
            'level'                 => 'required',
            'logtime'               => 'required',
            'category'              => 'required',
        ];
    }
    
     /**
     * Get level
     * @return String Level
     */
    public function getLevel()
    {
        if ((self::LOG_LEVELS[$this->level]) != null)
        {
            return self::LOG_LEVELS[$this->level];
        }
        return '';
    }
    
    /**
     * 
     * @return type
     */
     public function getLogtime()
     {
        if (isset($this->created_at))
        {
            $arr = explode(' ', $this->created_at);
            return $arr[0] . ' ' . $arr[1] . ' <strong>' . $this->logtime . '</strong>';
        }
        return $this->logtime;
    }
      /**
     * Insert record
     * @param String $description   Description
     * @param String $message       Message
     * @param String $level         Level
     * @param String $category      Category
     */
    public static function insertOne($description, $message, $level, $category)
    {
        $model = new AdminLogger();
        $model->description     = $message;
        $model->message         = $description;
        $model->level           = $level;
        $model->category        = $category;
        $model->ip_address      = CommonProcess::getUserIP();
        $model->country         = CommonProcess::getUserCountry($model->ip_address);
        $model->logtime         = microtime(true);
        $model->save();
    }
    
      /**
     * Log info
     * @param String $message       Message
     * @param String $description   Description
     * @param String $category      Category
     */
    public static function info($message, $description, $category)
    {
        self::insertOne($message, $description, self::LOG_LEVEL_INFO, $category);
    }

    /**
     * Log warning
     * @param String $message       Message
     * @param String $description   Description
     * @param String $category      Category
     */
    public static function warning($message, $description, $category)
    {
        self::insertOne($message, $description, self::LOG_LEVEL_WARNING, $category);
    }

    /**
     * Log error
     * @param String $message       Message
     * @param String $description   Description
     * @param String $category      Category
     */
    public static function error($message, $description, $category)
    {
        self::insertOne($message, $description, self::LOG_LEVEL_ERROR, $category);
    }
    
    /**
     * Log when create model failed
     * @param BaseModel $model BaseModel object
     * @param String $category      Category
     */
    public static function createModelFailed($model, $category)
    {
        self::error('Create the model failed', CommonProcess::json_encode_unicode($model->toArray()), $category);
    }
    
    /**
     * Log when update model failed
     * @param BaseModel $model BaseModel object
     * @param String $category      Category
     */
    public static function updateModelFailed($model, $category)
    {
        self::error('Update the model failed', CommonProcess::json_encode_unicode($model->toArray()), $category);
    }
}
