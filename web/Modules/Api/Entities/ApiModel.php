<?php

namespace Modules\Api\Entities;

use App\Entities\BaseModel;
use App\Utils\DomainConst;
use App\Utils\CommonProcess;
use Modules\Admin\Entities\AdminLogger;

/**
 * This is the base model class for api module models.
 *
 */
class ApiModel extends BaseModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    /** Response messages */
    const RESP_MSG_MISS_ROOT        = 'Missing r as a param. Ex: user/loginFirstTime?r={"username":"01234567890"}';
    const RESP_MSG_INVALID_JSON     = 'Invalid JSON encoding format';
    const RESP_MSG_INVALID_REQ      = 'Invalid request. Please check of http verb';
    const RESP_MSG_MISS_PARAM       = 'Missing param in record';
    
    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * Get default failed response
     * @return Array Key=>value array
     */
    public static function getDefaultFailedResponse() {
        return [
            'status'     => DomainConst::API_RESPONSE_STATUS_FAILED,
            'code'       => DomainConst::API_RESPONSE_CODE_BAD_REQUEST,
            'message'    => 'Invalid request. Please check http verb, action url and param',
        ];
    }

    /**
     * Get default success response
     * @return Array Key=>value array
     */
    public static function getDefaultSuccessResponse() {
        return [
            'status'     => DomainConst::API_RESPONSE_STATUS_SUCCESS,
            'code'       => DomainConst::API_RESPONSE_CODE_SUCCESS,
            'message'    => 'Success',
        ];
    }
}
