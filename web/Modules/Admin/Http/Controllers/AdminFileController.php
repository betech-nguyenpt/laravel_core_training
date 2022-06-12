<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Modules\Admin\Entities\AdminFile;

class AdminFileController extends BaseAdminController
{
    /** Class of model */
    public $modelClass = '\Modules\Admin\Entities\AdminFile';
    /** Name of controller */
    public $controllerName = 'admin-files';
    
    /**
     * Create Admin File
     * @param Request $request
     * @return Response
     */
    public function doUpload(Request $request)
    {
        $this->validate($request, [
            'fileUpload' => 'required']
        );
        $fileName = AdminFile::uploadFile($request);
        if (empty($fileName)) {
            return Redirect::back()->withErrors("Falied to upload. Only accept " . json_encode(AdminFile::getAllowFileExtensionByType($request->file_type)) . " for this file type");
        } else {
            $request->merge(['file_name' => $fileName]);
            AdminFile::create($request->except(['_token', 'q', 'fileUpload']));
            return redirect()->route('admin-files.index')->with('success', 'Model created successfully.');
        }
    }

    /**
     * Update Admin File
     *
     * @param  Request $request
     * @param  mixed $adminFile
     * @return void
     */
    public function doUpdate(Request $request)
    {
        $model = AdminFile::find($request->id);
        $this->validate($request, [
            'fileUpload' => 'required']
        );
        $fileName = AdminFile::uploadFile($request);
        if (empty($fileName)) {
            return Redirect::back()->withErrors("Falied to upload. Only accept " . json_encode(AdminFile::getAllowFileExtensionByType($request->file_type)) . " for this file type");
        } else {
            $model->deleteFile();
            $request->merge(['file_name' => $fileName]);
            $model->fill($request->except(['_token', 'q', 'fileUpload']))->save();
            return redirect()->route('admin-files.index')->with('success', 'Model updated successfully.');
        }
    }

    /**
     * Delete Admin File
     *
     * @param  Request $request
     * @param  mixed $adminFile
     * @return void
     */
    public function doDelete(Request $request)
    {
        AdminFile::find($request->id)->delete();
        return redirect()->route('admin-files.index')->with('success', 'Model deleted successfully.');
    }
}
