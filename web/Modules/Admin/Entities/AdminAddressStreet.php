<?php

namespace Modules\Admin\Entities;

use App\Entities\RootModel;
use Modules\Admin\Entities\AdminController;

/**
 * This is the model class for table "admin_address_streets".
 *
 * @property int $id                Id
 * @property int $city_id           City ID
 * @property string $name           Name
 * @property string $short_name     Short name
 * @property string $code_no        Code No
 * @property string $slug           Slug
 */
class AdminAddressStreet extends RootModel
{
    public $timestamps = false;
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
         'name', 'city_id', 'short_name', 'slug', 'code_no'
    ];

    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-address-streets', ['id' => $this->id]);
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
            'city_id'        => 'required',
            'short_name'     => 'required',
            'slug'           => 'required',
            'code_no'        => 'required',
        ];
    }
}