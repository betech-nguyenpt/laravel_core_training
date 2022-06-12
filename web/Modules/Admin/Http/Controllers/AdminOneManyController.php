<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\AdminOneMany;

class AdminOneManyController extends BaseAdminController
{
    /** Class of model */
    public $modelClass = '\Modules\Admin\Entities\AdminOneMany';
    /** Name of controller */
    public $controllerName = 'admin-one-many';
}
