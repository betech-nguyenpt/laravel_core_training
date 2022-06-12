<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('reset-password', 'AdminUserController@sentEmail')->name('resetPassword');
Route::post('new-password', 'AdminUserController@newPassword')->name('newPassword');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index');
    Route::resource('admin-modules', 'AdminModuleController');
    Route::resource('admin-controllers', 'AdminControllerController');
    Route::resource('admin-actions', 'AdminActionController');
    Route::resource('admin-menu', 'AdminMenuController');
    Route::resource('admin-loggers', 'AdminLoggerController');
    Route::resource('admin-roles', 'AdminRoleController');
    Route::get('admin-users/forgot-password', 'AdminUserController@getForgotPassword');
    Route::get('admin-users/force-reset-password/{code}', 'AdminUserController@checkCodeResetPassword');
    Route::get('admin-users/change-password', 'AdminUserController@getViewChangePassword');
    Route::post('admin-users/update-change-password', 'AdminUserController@changePassword')->name('changePassword');
    Route::resource('admin-users', 'AdminUserController');
    Route::resource('admin-record-logs', 'AdminRecordLogController');
    Route::resource('admin-activity-logs', 'AdminActivityLogController');
    Route::get('admin-roles/{id}/authorization', 'AdminRoleController@authorization');
    Route::resource('admin-page-counts', 'AdminPageCountController');
    Route::resource('admin-auto-emails', 'AdminAutoEmailController');
    Route::get('admin-roles/{id}/permission', 'AdminRoleController@permission');
    Route::get('admin-roles/{id}/permissionAll', 'AdminRoleController@permissionAll');
    Route::resource('admin-address-nations', 'AdminAddressNationController');
    Route::resource('admin-address-cities', 'AdminAddressCityController');
    Route::resource('admin-address-wards', 'AdminAddressWardController');
    Route::resource('admin-address-districts', 'AdminAddressDistrictController');
    Route::resource('admin-address-streets', 'AdminAddressStreetController');
    Route::resource('admin-settings', 'AdminSettingController');
    Route::post('update-admin-settings', ['as' => 'admin.update-admin-settings', 'uses' => 'AdminSettingController@updateSetting']);
    Route::resource('admin-one-many', 'AdminOneManyController');
    Route::resource('admin-change-pass-requests', 'AdminChangePassRequestController');
    Route::resource('admin-calendars', 'AdminCalendarController');

    //Calendar Manager
    Route::get('getListCalendars', ['as' => 'admin.getListCalendars', 'uses' => 'AdminCalendarController@getListCalendars']);
    Route::post('createCalendar', ['as' => 'admin.createCalendar', 'uses' => 'AdminCalendarController@createCalendar']);
    Route::post('deleteCalendar', ['as' => 'admin.deleteCalendar', 'uses' => 'AdminCalendarController@deleteCalendar']);
    Route::post('updateCalendar', ['as' => 'admin.updateCalendar', 'uses' => 'AdminCalendarController@updateCalendar']);
    Route::post('searchCalendar', ['as' => 'admin.searchCalendar', 'uses' => 'AdminCalendarController@searchCalendar']);

    Route::resource('admin-files', 'AdminFileController');
    Route::post('admin-files', ['as' => 'admin.doUpload', 'uses' => 'AdminFileController@doUpload']);
    Route::post('admin-files/update/{id}', ['as' => 'admin.doUpdate', 'uses' => 'AdminFileController@doUpdate']);
    Route::post('admin-files/delete/{id}', ['as' => 'admin.doDelete', 'uses' => 'AdminFileController@doDelete']);

    Route::resource('admin-notification', 'AdminNotificationController');
    Route::post('admin-notification/read/{id}', ['as' => 'admin.doRead', 'uses' => 'AdminNotificationController@read']);
    Route::post('admin-notification/readAll', ['as' => 'admin.readAllNotify', 'uses' => 'AdminNotificationController@readAll']);
    Route::post('admin-notification/send', ['as' => 'admin-notification.send', 'uses' => 'AdminNotificationController@send']);
    Route::get('admin/admin-notification/demo', ['as' => 'admin-notification.demo', 'uses' => 'AdminNotificationController@demo']);
});
