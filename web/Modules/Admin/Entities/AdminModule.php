<?php

namespace Modules\Admin\Entities;

use Modules\Admin\Entities\AdminController;

/**
 * This is the model class for table "admin_modules".
 *
 * @property int $id                Id
 * @property string $name           Name
 * @property string $description    Description
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminModule extends AdminModel
{
//    use CapturesActivity;
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'name', 'description', 'status', 'created_by'
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-modules', ['id' => $this->id]);
    }
    
    /**
     * Get list controllers
     * @return AdminController List controllers
     */
    public function getListControllers() {
        return AdminController::where('module_id', $this->id)
                    ->where('status', '<>', AdminController::STATUS_INACTIVE)
                    ->get();    
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
            'description'   => 'required',
        ];
    }
}
