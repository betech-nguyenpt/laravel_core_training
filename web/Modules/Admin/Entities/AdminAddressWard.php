<?php

namespace Modules\Admin\Entities;

use App\Entities\RootModel;
use Modules\Admin\Entities\AdminController;

/**
 * This is the model class for table "admin_address_wards".
 *
 * @property int $id                Id
 * @property int $district_id       District Id
 * @property string $name           Name
 * @property string $short_name     Short name
 * @property string $code_no        Code no
 * @property string $slug           Slug
 */
class AdminAddressWard extends RootModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    public $timestamps = false;

    protected $fillable = [
         'name', 'district_id', 'short_name', 'slug', 'code_no'
    ];

    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-address-wards', ['id' => $this->id]);
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
            'name'           => 'required',
            'district_id'    => 'required',
            'short_name'     => 'required',
            'slug'           => 'required',
            'code_no'        => 'required',
        ];
    }
}
