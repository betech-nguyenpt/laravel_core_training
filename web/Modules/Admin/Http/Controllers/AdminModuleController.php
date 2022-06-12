<?php

namespace Modules\Admin\Http\Controllers;

class AdminModuleController extends BaseAdminController
{
    /** Class of model */
    public $modelClass      = '\Modules\Admin\Entities\AdminModule';
    /** Name of controller */
    public $controllerName  =   'admin-modules';
}
