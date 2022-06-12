<?php

namespace Modules\Admin\Entities;

use App\Entities\RootModel;

/**
 * This is the model class for table "admin_settings".
 *
 * @property int $id                    Id
 * @property datetime $updated          Updated time
 * @property string $key                Key
 * @property string $value              Value
 * @property string $description        Description

 */
class AdminSetting extends RootModel
{
    public $timestamps = false;
    public static $aSettings = [
        [
            'alias' => 'General Settings',
            'children' => [
                'domain'                    => 'text',
                'site_title'                => 'text',
                'backend_theme'             => 'select',
                'frontend_theme'            => 'select',
                'language'                  => 'select',
                'backend_items_per_page'    => 'text',
            ],
        ],
    ];

    public static $selectValue = [
        'language' => [
            'en-US' => 'en-US',
            'ja-JP' => 'ja-JP',
        ],
        'backend_theme' => [
            'basic' => 'basic',
        ],
        'frontend_theme' => [
            'jackson' => 'jackson',
        ],
    ];

    //    use CapturesActivity;
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'updated', 'key', 'value', 'description',
    ];

    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('admin/admin-settings', ['id' => $this->id]);
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
            'updated' => 'required',
            'key' => 'required',
            'value' => 'required',
        ];
    }

    /**
     * Get value by key
     *
     * @param  mixed $key
     * @return void
     */
    public static function getValue($key)
    {
        return self::where('key', $key)->first()->value;
    }
}
