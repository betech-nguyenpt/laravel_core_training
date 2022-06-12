<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Entities\ApiToken;

class ApiTokenController extends BaseApiController
{
    /** Class of model */
    public $modelClass      = '\Modules\Api\Entities\ApiToken';
    /** Name of controller */
    public $controllerName  = 'api-tokens';
}
