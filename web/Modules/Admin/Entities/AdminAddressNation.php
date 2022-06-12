<?php

namespace Modules\Admin\Entities;

/**
 * This is the model class for table "admin_address_nations".
 *
 * @property int $id                Id
 * @property string $name           Name
 * @property string $name_en        English Name
 * @property int $description       Description
 * @property int $code_no           Code No
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminAddressNation extends AdminModel
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
        'name', 'name_en', 'description', 'code_no'
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-address-nations', ['id' => $this->id]);
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
            'name_en'        => 'required',
            'description'    => 'required',
            'code_no'        => 'required',
        ];
    }
}