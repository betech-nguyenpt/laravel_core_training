<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Api\Entities\ApiModel;
use Modules\Admin\Entities\AdminUser;
use Modules\Api\Http\Controllers\ApiController;
use Exception;
use App\Utils\CommonProcess;
use Illuminate\Support\Facades\Auth;
use Modules\Api\Entities\ApiToken;

class AuthController extends ApiController
{
    const KEY_USERNAME          = 'username';
    const KEY_PASSWORD          = 'password';
    const KEY_DEVICE_TOKEN      = 'device_token';
    const KEY_TOKEN             = 'token';
    const KEY_EMAIL             = 'email';
    const KEY_CODE              = 'code';
    /**
     * Action login
     * @return response Response from login
     * @throws Exception
     */
    public function actionLogin() {
        try {
            $root = $this->checkRequest([
                self::KEY_USERNAME,
                self::KEY_PASSWORD,
                self::KEY_DEVICE_TOKEN,
            ]);
            $mToken = $this->mUser->login($root[self::KEY_USERNAME],
                $root[self::KEY_PASSWORD],
                $root[self::KEY_DEVICE_TOKEN],
                $root[self::KEY_PLATFORM]);
            if ($mToken) {
                return $this->sendResponse($this->mUser->loginResp($mToken));
            } else {
                throw new Exception('Token not found');
            }
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }
    
    /**
     * Action logout
     * @return response Response from logout
     * @throws Exception
     */
    public function actionLogout() {
        try {
            $root = $this->checkRequest([
                self::KEY_TOKEN,
            ]); 
            $mToken  = $this->mUser->logout($root[self::KEY_TOKEN]);
            if ($mToken) {
                return $this->sendResponse($this->mUser->logoutResp());
            } else {
                throw new Exception('Token not found');
            }       
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }
    
    /**
     * Action Register
     * @return response Response from register
     * @throws Exception
     */
    public function actionRegister() {
        try {
            $root = $this->checkRequest([
                self::KEY_USERNAME,
                self::KEY_EMAIL,
                self::KEY_PASSWORD,
                self::KEY_DEVICE_TOKEN, 
            ]);
            $mReg = $this->mUser->register(
                    $root[self::KEY_USERNAME],
                    $root[self::KEY_EMAIL],
                    $root[self::KEY_PASSWORD]
                    );
            if ($mReg) {
                return $this->sendResponse($this->mUser->registerResp());
            } else {
                throw new Exception('Code not found');
            }
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }
    
    /**
     * Action Verify
     * @return response Response from verify
     * @throws Exception
     */
    public function actionVerify() {
        try {
            $root = $this->checkRequest([
                self::KEY_CODE, 
            ]);
            $mReg = $this->mUser->verify(
                    $root[self::KEY_CODE]
                    );
            if ($mReg){
                $token = CommonProcess::generateSessionId();
                return $this->sendResponse($this->mUser->verifyResp($token));
            }
            else {
                throw new Exception('The code is not correct');
            }
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }       
    }
    
    /**
     * Action get user profile 
     * @return response Response from get user profile
     * @throws Exception
     */
    public function actionGetUserProfile() {
        try {
            $root = $this->checkRequest([
                self::KEY_TOKEN, 
            ]);
            $resp = $this->mUser->getUserProfile($root[self::KEY_TOKEN]);
            return $this->sendResponse($resp);
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }
}
