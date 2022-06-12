<?php

namespace Modules\Admin\Http\Controllers;

class AdminAutoEmailController extends BaseAdminController
{
    /** Class of model */
    public $modelClass      = '\Modules\Admin\Entities\AdminAutoEmail';
    /** Name of controller */
    public $controllerName  =   'admin-auto-emails';
    
    public function index() {
        return parent::index();
    }
}
