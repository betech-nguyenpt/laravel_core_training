<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Entities\AdminLogger;

class AdminLoggerController extends BaseAdminController
{
    /** Class of model */
    public $modelClass      = '\Modules\Admin\Entities\AdminLogger';
    /** Name of controller */
    public $controllerName  = 'admin-loggers';
    
    /**
     * Remove all loggers
     * TODO: still error
     * @return \Illuminate\Http\Response
     */
    public function delete() {
        AdminLogger::truncate();
        return redirect()->route($this->getIndexView(false))
                ->with('success', 'Model deleted successfully.');
    }
}
