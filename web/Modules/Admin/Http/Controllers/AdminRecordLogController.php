<?php

namespace Modules\Admin\Http\Controllers;

class AdminRecordLogController extends BaseAdminController
{
    /** Class of model */
    public $modelClass      = '\Modules\Admin\Entities\AdminRecordLog';
    /** Name of controller */
    public $controllerName  =   'admin-record-logs';
    
    public function index() {
        return parent::index();
    }
}
