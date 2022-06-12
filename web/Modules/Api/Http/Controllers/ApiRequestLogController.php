<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Entities\ApiRequestLog;

class ApiRequestLogController extends BaseApiController
{
    /** Class of model */
    public $modelClass      = '\Modules\Api\Entities\ApiRequestLog';
    /** Name of controller */
    public $controllerName  = 'api-request-logs';
    
    /**
     * Remove all loggers
     * TODO: still error
     * @return \Illuminate\Http\Response
     */
    public function delete() {
        ApiRequestLog::truncate();
        return redirect()->route($this->getIndexView(false))
                ->with('success', 'Model deleted successfully.');
    }
}
