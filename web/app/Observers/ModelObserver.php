<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admin\Entities\AdminRecordLog;

/**
 * Description of ModelObserver
 *
 * @author nguyenpt
 */
class ModelObserver
{
    /** Except fields */
    private $_exceptFields = array(
        'created_at',
        'updated_at',
    );
    /**
     * Handle the model "created" event.
     *
     * @param  BaseModel  $model  Model to record
     * @return void
     */
    public function created($model)
    {
        AdminRecordLog::insertRecord(Auth::user()->name, $model);
    }

    /**
     * Handle the model "updated" event.
     *
     * @param  BaseModel  $model  Model to record
     * @return void
     */
    public function updated($model)
    {
        if ($model->isDirty())
        {
            $datachage = $model->getChanges();
            foreach ($datachage as $key => $value)
            {
                if (!in_array($key, $this->_exceptFields)) {
                    AdminRecordLog::updateRecord(Auth::user()->name, $model,
                            $key, $model->getOriginal($key));
                }
            }
        }
    }

    /**
     * Handle the model "deleted" event.
     *
     * @param  BaseModel  $model  Model to record
     * @return void
     */
    public function deleted($model)
    {
        AdminRecordLog::deleteRecord(Auth::user()->name, $model);
    }
}
