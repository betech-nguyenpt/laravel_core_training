<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Entities\ApiRequestLog;
use Modules\Api\Entities\ApiModel;
use Modules\Api\Entities\ApiUser;
use App\Utils\CommonProcess;
use Exception;

class ApiController extends Controller
{
    const KEY_ROOT_REQUEST      = 'r';
    const KEY_PLATFORM          = 'platform';
    const KEY_VERSION_CODE      = 'version';
    /**
     * Request model
     * @var ApiRequestLog
     */
    private $mRequestLog;
    
    /**
     * User model
     * @var ApiUser
     */
    protected $mUser;
    
    public function __construct() {
        $this->mUser = new ApiUser();
    }
    
    /**
     * Check request
     * @param String[] $arrRequiredFields Array of field names
     * @return Array Key=>value array
     */
    public function checkRequest($arrRequiredFields) {
        // TODO: Check setting can log api request
        $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        if ($method == 'POST') {    // Force to developer only use POST method when call API
//            die(print_r($_POST));
//            CommonProcess::vardumb($_POST['r']);
//            CommonProcess::vardumb(filter_input(INPUT_POST, self::KEY_ROOT_REQUEST));
//            throw new Exception(CommonProcess::json_encode_unicode($_POST));
//            throw new Exception(CommonProcess::json_encode_unicode($_POST['r']));
            if (empty(filter_input(INPUT_POST, self::KEY_ROOT_REQUEST))) {
                // Send failed response
//                return $this->sendFailedResponse(ApiModel::RESP_MSG_MISS_ROOT);
                throw new Exception(ApiModel::RESP_MSG_MISS_ROOT);
            } else 
            {
                // Convert data to array (Key=>Value)
                $root = json_decode(filter_input(INPUT_POST, self::KEY_ROOT_REQUEST), true);
//                CommonProcess::vardumb($root);
                if (!is_array($root)) 
                {
                    // Send failed response
//                    return $this->sendFailedResponse(ApiModel::RESP_MSG_INVALID_REQ);
                    throw new Exception(ApiModel::RESP_MSG_INVALID_REQ);
                }
                $inputArrRequiredFields = $arrRequiredFields;
                $inputArrRequiredFields[] = self::KEY_PLATFORM;
                $inputArrRequiredFields[] = self::KEY_VERSION_CODE;
                $this->checkRequiredParam($root, $inputArrRequiredFields);
                return $root;
            }
        } else {
            // Send failed response
//            return $this->sendFailedResponse(ApiModel::RESP_MSG_INVALID_REQ);
            throw new Exception(ApiModel::RESP_MSG_INVALID_REQ);
        }
    }
    /**
     * Check required parameters
     * @param Array/Object $root Root values
     * @param String[] $arrFields Array of field names
     */
    public function checkRequiredParam($root, $arrFields) {
        $arrInvalidFields = [];
        $isValid = true;
        if (is_array($root)) {
            foreach ($arrFields as $field) {
                if (!isset($root[$field])) {
                    $isValid = false;
                    $arrInvalidFields[] = $field;
                }
            }
        } else {
            foreach ($arrFields as $field) {
                if (!isset($root->$field)) {
                    $isValid = false;
                    $arrInvalidFields[] = $field;
                }
            }
        }
        if (!$isValid) {
            $result = ApiModel::getDefaultFailedResponse();
            $result['message']  = ApiModel::RESP_MSG_MISS_PARAM;
            $result['record']   = json_encode($arrInvalidFields);
            throw new Exception($result);
        }
    }
    
    /**
     * Update log response
     * @param String $response Response value
     */
    public function updateLogResponse($response) {
        if ($this->mRequestLog) {
            $this->mRequestLog->response = $response;
//            $this->mRequestLog->responsed_date = DateTimeExt::getCurrentDateTime();
            if (!$this->mRequestLog->save()) {
//                AdminLoggers::updateModelFailed($this->mRequestLog,
//                        __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            }
        }
    }
    
    /**
     * Get user by token
     * @param String $token Token
     * @return ApiUsers User model
     */
//    public function getUserByToken($token) {
//        $mUser = ApiUserTokens::findUserByToken($token);
//        if (!$mUser || !$mUser->isActive()) {
//            $result = ApiModule::getDefaultFailedResponse();
//            $result[DomainConst::KEY_CODE]      = DomainConst::API_RESPONSE_CODE_UNAUTHORIZED;
//            $result[DomainConst::KEY_MESSAGE]   = Yii::t(DomainConst::KEY_TRANSLATE_APP, DomainConst::CONTENT00162);
//            ApiModule::sendResponse($result, $this);
//        }
//        $this->setLogUserId($mUser->id);
//        return $mUser;
//    }
    
    /**
     * Set log user id
     * @param String $user_id Id of user
     */
//    public function setLogUserId($user_id) {
//        if ($this->mRequestLog) {
//            $this->mRequestLog->user_id = $user_id;
//        }
//    }
    
    /**
     * Send response
     * @param Array $data Data
     */
    public function sendResponse($data) {
        $json = CommonProcess::json_encode_unicode($data);
        // TODO: Check setting can log api request
//        $this->updateLogResponse($json);
        return response()->json($data);
    }
    
    /**
     * Send failed response
     * @param String $msg Message
     */
    public function sendFailedResponse($msg) {
        $result = ApiModel::getDefaultFailedResponse();
        $result['message'] = $msg;
        return $this->sendResponse($result);
    }
    
    /**
     * Send default success response
     * @param String $msg Message
     */
    public function sendDefaultSuccessResponse($msg) {
        $result = ApiModel::getDefaultSuccessResponse();
        $result['message'] = $msg;
        return $this->sendResponse($result);
    }
    
    /**
     * Catch error when exception occur.
     * @param Exception $ex Exception
     */
    public function catchError($ex) {
        return $this->sendFailedResponse('' . $ex->getMessage());
    }
}
