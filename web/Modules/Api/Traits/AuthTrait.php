<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Modules\Api\Traits;

use Modules\Admin\Entities\AdminUser;
use Modules\Api\Entities\ApiToken;
use Illuminate\Support\Facades\Auth;
use App\Utils\CommonProcess;
use Modules\Admin\Http\Controllers\AdminUserController;
use Modules\Api\Entities\ApiModel;
use Modules\Api\Entities\ApiRegRequest;
use Illuminate\Support\Facades\Hash;
use Mail;
use Redirect;
use App\Mail\SendEmail;
use Exception;

/**
 * Description of Auths
 *
 * @author Trung
 */
trait AuthTrait {
    /**
     * Handle login
     * @param string $username Username
     * @param string $password Password
     * @param string $device_token Token of device
     * @return ApiTokens Token model
     */
    public function login($username, $password, $device_token, $platform) {
        // Get user from username
        $this->mUser = null;
        $this->mUser = AdminUser::where('username', $username)->first();
        if (!$this->mUser) {
           throw new Exception('User not found');
        }
        
        // Validate password
        if (!$this->mUser->validateLogin($password)) {
           throw new Exception('Wrong password'); 
        }
        
        // Get token model
        return ApiToken::insertOne($this->mUser->id, $platform, $device_token);
    }
    
    /**
     * Create login response
     * @param ApiToken $mToken Token model
     * @return array Key=>value
     */
    public function loginResp($mToken) {
        $retVal = ApiModel::getDefaultSuccessResponse();
        $retVal['message']  = 'Login success';
        $retVal['data']     = [
            'token'     => $mToken->token,
            'user_info' => $this->mUser->getUserInfo(),
        ];
        return $retVal;
    }
    
    /**
     * Handle logout
     * @param string $token Token
     * @return type User model
     * @throws Exception
     */
    public function logout($token) {
       $mToken = ApiToken::findUserByToken($token);
       if (!$mToken) {
           return null;
       } else {
           $mToken->status = ApiToken::STATUS_LOGOUT;
           $mToken->save();
           return $mToken;
       }
    }
    
    
    /**
     * Create logout response
     * @return array Key=>value
     */
    public function logoutResp() {
        $retVal = ApiModel::getDefaultSuccessResponse();
        $retVal['message']  = 'Logout success';
        return $retVal;
    }
    
    /**
     * Handle register
     * @param type $username Username
     * @param type $email Email
     * @param type $password Password
     * @return ApiRegRequest Register requests model
     */
    public function register($username, $email, $password) {
        $modelUser = AdminUser::where([
            'email'     => $email,
            'status'    => AdminUser::STATUS_REGISTERING,
            ])->first();
        if (!$modelUser){
            $checkEmail = AdminUser::where('email', $email)->first();
            if ($checkEmail) {
                throw new Exception('This email already in use');
            } else {  
                $checkUserName = AdminUser::where('username', $username)->first();
                if ($checkUserName) {
                    throw new Exception('This user name already exists');
                } 
                    AdminUser::create([
                        'username' => $username,
                        'email'    => $email,
                        'password' => Hash::make($password),
                        'status'   => AdminUser::STATUS_REGISTERING,
                    ]);
            }
        }
        return ApiRegRequest::insertOne($email, $password); 
    }
    
    /**
     * Create register response
     * @return array Key=>value
     */
    public function registerResp() {
        $retVal = ApiModel::getDefaultSuccessResponse();
        $retVal['message']  = 'Register success';
        return $retVal;
    }
    
    /**
     * Handle verify
     * @param string $code Code
     * @return ApiRegRequest Register requests model
     */
    public function verify($code) {
        $mReg = ApiRegRequest::where('code', $code)->first();
        if ($mReg){
            $verifyOTP = ApiRegRequest::verifyOTP($mReg->phone, $code);
            if($verifyOTP) {
                $this->mUser = AdminUser::where('email', $mReg->phone)->first();
                $this->mUser->status = AdminUser::STATUS_ACTIVE;
                $this->mUser->save();
                return $mReg;
            } else {
                throw new Exception('Out of verification time');
            }
        } 
        return null;
    }
    
    /**
     * Create verify response
     * @param string $token Token 
     * @return array Key=>value
     */
    public function verifyResp($token) {
        $retVal = ApiModel::getDefaultSuccessResponse();
        $retVal['message']  = 'Verify success';
        $retVal['data']     = [
            'token'     => $token,
            'user_info' => $this->mUser->getUserInfo(),
        ];
        
        return $retVal;
    }
    
    /**
     * Handle get user profile
     * @param Apitoken $token Token model
     * @throws Exception
     */
    public function getUserProfile($token) {
        $retVal = [];
        $mToken = ApiToken::where('token', $token)->first();
        if ($mToken) {
            $this->mUser = null;
            $this->mUser = AdminUser::find($mToken->user_id);
            if (!$this->mUser) {
                throw new Exception('User not found');
            }
            $retVal = $this->userProfileResp();
        } else {
            throw new Exception('Token not found');
        }
        return $retVal;
    }
    
    /**
     * Create user profile response
     * @return array Key=>value
     */
    public function userProfileResp() {
        $retVal = ApiModel::getDefaultSuccessResponse();
        $retVal['message']  = 'Get user profile success';
        $retVal['data']     = [
            'user_info' => $this->mUser->getUserInfo(),
        ];
        return $retVal;
    }
}
