<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Entities\AdminUser;
use Modules\Admin\Entities\AdminChangePassRequest;
use Modules\Admin\Entities\AdminAutoEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\AdminNotification;

class AdminUserController extends BaseAdminController
{
    /** Class of model */
    public $modelClass      = '\Modules\Admin\Entities\AdminUser';
    /** Name of controller */
    public $controllerName  =   'admin-users';
    
    /**
     * get view forgotPassword
     * @return type
     */
    public function getForgotPassword()
    {
        $model = new AdminUser();
        $controller = $this->controllerName;
        $getForgotPassword = 1;
        return view('admin::admin-users.forgot-password', 
               compact('model', 'controller', 'getForgotPassword'));
    }
    
    /**
     * Request sent Email
     * @param Request $request
     * @return type
     */
    public function sentEmail(Request $request)
    {
        $email    = AdminUser::where('email', $request->email)->first();
        $user_id  = auth()->user()->username;
        if (isset($email) && $user_id==$email->username)
        {
            AdminChangePassRequest::insertOne($user_id);
            Session::put('resetPasword_0158', 100);
            $code = AdminChangePassRequest::where('user_id', $user_id)->latest()->first();
            $link = url('admin/admin-users/force-reset-password/'.$code->code);
            $content = 'Reset password: <br>'.$link;
            
            AdminAutoEmail::sendEmail('Reset Password', $content, $request->email);
            
            return redirect()->back()->with('success');
        }
        else
        {
            return redirect()->back()->with('warning');
        }
    }
    
    /**
     * Check code for reset password
     * @param Request $request
     * @param type $code
     * @return type
     */
    public function checkCodeResetPassword(Request $request, $code)
    {
        $getCode = AdminChangePassRequest::where('code', $code)->first();
        $session = Session::has('resetPasword_0158');
        if($getCode && $session)
        {
            Session::forget('resetPasword_0158');
            $model = new AdminUser();
            $controller = $this->controllerName;
            $getForgotPassword = 1;
            $newPassword = 1;
            return view('admin::admin-users.new-password', compact('code', 
                    'model', 'controller', 'getForgotPassword', 'newPassword')) ;
        }
        else
        {
            echo 'This link is expired';
        }
    }
    
    
    /**
     * Update new Password
     * @param Request $request
     * @return type
     */
    public function newPassword(Request $request) 
    {
        $username = AdminChangePassRequest::where('code', $request->code)->first();
        if ($request->password == $request->confirm) 
        {
            AdminUser::where('username', $username->user_id)
                    ->update(['password' => Hash::make($request->password)]);
            Auth::logout();
            return redirect()->route('login');
        } 
        else 
        {
            return redirect()->back()->with('passwordNotMatch');
        }
    }

    /**
     * get view change password
     * @return type
     */
    public function getViewChangePassword()
    {
        $model = new AdminUser();
        $controller = $this->controllerName;
        $changePassword = 1;
        return view('admin::admin-users.change-password', 
               compact('model', 'controller', 'changePassword'));
    }
    
    /**
     * change password
     * @param Request $request
     * @return type
     */
    public function changePassword(Request $request) {
        $pass = auth()->user()->password;
        $oldPass = $request->oldPassword;
        if (Hash::check($pass, $oldPass))
            return redirect()->back()->with('oldPasswordIncorrect');
        else 
        {
            if ($request->password == $request->confirm) 
            {
                $email = Auth::user()->email;
                AdminUser::where('email', $email)
                        ->update(['password' => Hash::make($request->password)]);
                Auth::logout();
                return redirect()->route('login');
            } 
            else 
            {
                return redirect()->back()->with('passwordNotMatch');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(AdminUser::getRules());
        $user = AdminUser::create($request->all());
        $content = 'User <strong>' . Auth::user()->name . '</strong> was <strong> CREATED </strong> a user';     
        AdminNotification::send(AdminNotification::TYPE_SEND_ONE, 1, $content, $user->getShowLink());
        return redirect()->route($this->getIndexView(false))
            ->with('success', 'Model created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id                   Id of model AdminUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(AdminUser::getRules());
        $user = AdminUser::find($id);
        $user->update($request->all());
        $content = 'User <strong>' . Auth::user()->name . '</strong> was <strong> UPDATE </strong> a user';
        AdminNotification::send(AdminNotification::TYPE_SEND_ONE, 1, $content, $user->getShowLink());
        return redirect()->route($this->getIndexView(false))
            ->with('success', 'Model updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id                      Id of model AdminUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = AdminUser::find($id);
        $user->delete();
        $content = 'User <strong>' . Auth::user()->name . '</strong> was <strong> DELETED </strong> a user';
        AdminNotification::send(AdminNotification::TYPE_SEND_ONE, 1, $content, '');
        return redirect()->route($this->getIndexView(false))
            ->with('success', 'Model deleted successfully.');
    }
}
