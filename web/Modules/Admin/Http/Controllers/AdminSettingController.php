<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\AdminSetting;

class AdminSettingController extends BaseAdminController
{
    /** Class of model */
    public $modelClass = '\Modules\Admin\Entities\AdminSetting';
    /** Name of controller */
    public $controllerName = 'admin-settings';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $models = AdminSetting::all();
        $aSettings = AdminSetting::$aSettings;
        $selectValue = AdminSetting::$selectValue;
        return view('admin::admin-settings.index', compact('models', 'aSettings', 'selectValue'));
    }
/**
 * Update the specified resource in storage.
 * @param Request $request
 * @return Response
 */
    public function updateSetting(Request $request)
    {
        foreach ($request->except(['_token', 'q']) as $key => $value) {
            AdminSetting::where('key', $key)->update(['value' => $value, 'updated' => date('Y-m-d H:i:s')]);
        }
        return back();
    }
}
