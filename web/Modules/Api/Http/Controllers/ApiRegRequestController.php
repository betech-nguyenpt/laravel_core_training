<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Entities\ApiRegRequest;

class ApiRegRequestController extends BaseApiController
{
    /** Class of model */
    public $modelClass      = '\Modules\Api\Entities\ApiRegRequest';
    /** Name of controller */
    public $controllerName  = 'api-reg-requests';
}
