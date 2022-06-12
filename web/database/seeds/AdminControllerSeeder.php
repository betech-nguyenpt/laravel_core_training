<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminController;

class AdminControllerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminController::truncate();
        $data = [
            [
                'id'            => '1',
                'name'          => 'admin-modules',
                'module_id'     => '1',
                'description'   => 'Modules',
            ],
            [
                'id'            => '2',
                'name'          => 'admin-controllers',
                'module_id'     => '1',
                'description'   => 'Controllers',
            ],
            [
                'id'            => '3',
                'name'          => 'admin-actions',
                'module_id'     => '1',
                'description'   => 'Actions',
            ],
            [
                'id'            => '4',
                'name'          => 'admin-menu',
                'module_id'     => '1',
                'description'   => 'Menu',
            ],
            [
                'id'            => '7',
                'name'          => 'admin-roles',
                'module_id'     => '1',
                'description'   => 'Roles',
            ],
            [
                'id'            => '8',
                'name'          => 'admin-loggers',
                'module_id'     => '1',
                'description'   => 'Loggers',
            ],
            [
                'id'            => '9',
                'name'          => 'admin-record-logs',
                'module_id'     => '1',
                'description'   => 'Record logs',
            ],
            [
                'id'            => '10',
                'name'          => 'admin-activity-logs',
                'module_id'     => '1',
                'description'   => 'Activity logs',
            ],
            [
                'id'            => '11',
                'name'          => 'admin-users',
                'module_id'     => '1',
                'description'   => 'Activity logs',
            ],
            [
                'id'            => '12',
                'name'          => 'admin-page-counts',
                'module_id'     => '1',
                'description'   => 'Page count',
            ],
            [
                'id'            => '13',
                'name'          => 'admin-auto-emails',
                'module_id'     => '1',
                'description'   => 'Automation emails',
            ],
            [
                'id'            => '14',
                'name'          => 'admin-address-nations',
                'module_id'     => '1',
                'description'   => 'Nations',
            ],
            [
                'id'            => '15',
                'name'          => 'admin-address-cities',
                'module_id'     => '1',
                'description'   => 'Cities',
            ],
            [
                'id'            => '16',
                'name'          => 'admin-address-districts',
                'module_id'     => '1',
                'description'   => 'Districts',
            ],
            [
                'id'            => '17',
                'name'          => 'admin-address-wards',
                'module_id'     => '1',
                'description'   => 'Address wards',
            ],
            [
                'id'            => '18',
                'name'          => 'admin-address-streets',
                'module_id'     => '1',
                'description'   => 'Address streets',
            ],
            [
                'id'            => '19',
                'name'          => 'admin-settings',
                'module_id'     => '1',
                'description'   => 'Admin settings',
            ],
            [
                'id'            => '20',
                'name'          => 'admin-one-many',
                'module_id'     => '1',
                'description'   => 'Admin one many',
            ],
            [
                'id'            => '21',
                'name'          => 'admin-files',
                'module_id'     => '1',
                'description'   => 'Admin files',
            ],
            [
                'id'            => '22',
                'name'          => 'admin-calendars',
                'module_id'     => '1',
                'description'   => 'Admin Calendar',
            ],
            [
                'id'            => '23',
                'name'          => 'admin-notification',
                'module_id'     => '1',
                'description'   => 'Admin Notification',
            ],
        ];
        AdminController::insert($data);
    }
}
