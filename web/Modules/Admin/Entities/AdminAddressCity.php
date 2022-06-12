<?php

namespace Modules\Admin\Entities;

use App\Entities\RootModel;

/**
 * This is the model class for table "admin_address_cities".
 *
 * @property int $id                Id
 * @property int $nation_id         Nation Id
 * @property string $name           Name
 * @property string $short_name     Short name
 * @property string $code_no        Code no
 * @property string $slug           Slug
 */
class AdminAddressCity extends RootModel
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
         'name', 'nation_id', 'short_name', 'slug', 'code_no'
    ];

    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-address-cities', ['id' => $this->id]);
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
            'nation_id'      => 'required',
            'short_name'     => 'required',
            'slug'           => 'required',
            'code_no'        => 'required',
        ];
    }
}
