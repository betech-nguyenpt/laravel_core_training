<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Admin\Http\Controllers;

/**
 * Description of AdminAddressDistrictController
 *
 * @author nguyenpt <nguyenpt@bisync.jp>
 */
class AdminAddressDistrictController extends BaseAdminController
{
    /** Class of model */
    public $modelClass      = '\Modules\Admin\Entities\AdminAddressDistrict';
    /** Name of controller */
    public $controllerName  =   'admin-address-districts';
}