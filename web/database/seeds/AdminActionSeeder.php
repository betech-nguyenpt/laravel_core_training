<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminAction;

class AdminActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminAction::truncate();
        $controller_admin_address_nations_id    = 14;
        $controller_admin_address_cities_id     = 15;
        $controller_admin_address_districts_id  = 16;
        $controller_admin_address_wards_id      = 17;
        $controller_admin_address_streets_id    = 18;
        $controller_admin_settings_id           = 19;
        $controller_admin_one_many_id           = 20;
        $controller_admin_files_id              = 21;
        $controller_admin_calendar_id           = 22;
        $controller_admin_notification_id       = 23;
        $data = [
            // Module
            [
                'id'                => '1',
                'controller_id'     => '1',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '2',
                'controller_id'     => '1',
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '3',
                'controller_id'     => '1',
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '4',
                'controller_id'     => '1',
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '5',
                'controller_id'     => '2',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '6',
                'controller_id'     => '2',
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '7',
                'controller_id'     => '2',
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '8',
                'controller_id'     => '2',
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '9',
                'controller_id'     => '3',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '10',
                'controller_id'     => '3',
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '11',
                'controller_id'     => '3',
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '12',
                'controller_id'     => '3',
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            // Menu
            [
                'id'                => '13',
                'controller_id'     => '4',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '14',
                'controller_id'     => '4',
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '15',
                'controller_id'     => '4',
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '16',
                'controller_id'     => '4',
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            // Role
            [
                'id'                => '17',
                'controller_id'     => '7',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '18',
                'controller_id'     => '7',
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '19',
                'controller_id'     => '7',
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '20',
                'controller_id'     => '7',
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '21',
                'controller_id'     => '7',
                'name'              => 'Authorization',
                'key'               => 'authorization',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '22',
                'controller_id'     => '8',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '23',
                'controller_id'     => '8',
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '24',
                'controller_id'     => '8',
                'name'              => 'Delete all',
                'key'               => 'deleteAll',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            // Record log
            [
                'id'                => '25',
                'controller_id'     => '9',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            // Activity log
            [
                'id'                => '26',
                'controller_id'     => '10',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            // Users
            [
                'id'                => '27',
                'controller_id'     => '11',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '28',
                'controller_id'     => '11',
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '29',
                'controller_id'     => '11',
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '30',
                'controller_id'     => '11',
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '31',
                'controller_id'     => '11',
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            // Page count
            [
                'id'                => '32',
                'controller_id'     => '12',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            // Auto emails
            [
                'id'                => '33',
                'controller_id'     => '13',
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '34',
                'controller_id'     => '7',
                'name'              => 'Ajax permission',
                'key'               => 'permission',
                'permission'        => AdminAction::PERMISSION_PUBLIC,
            ],
            [
                'id'                => '35',
                'controller_id'     => '7',
                'name'              => 'Ajax permission (for controller)',
                'key'               => 'permissionAll',
                'permission'        => AdminAction::PERMISSION_PUBLIC,
            ],

            // Address nations
            [
                'id'                => '36',
                'controller_id'     => $controller_admin_address_nations_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '37',
                'controller_id'     => $controller_admin_address_nations_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '38',
                'controller_id'     => $controller_admin_address_nations_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '39',
                'controller_id'     => $controller_admin_address_nations_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '40',
                'controller_id'     => $controller_admin_address_nations_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

            // Address cities
            [
                'id'                => '41',
                'controller_id'     => $controller_admin_address_cities_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '42',
                'controller_id'     => $controller_admin_address_cities_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '43',
                'controller_id'     => $controller_admin_address_cities_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '44',
                'controller_id'     => $controller_admin_address_cities_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '45',
                'controller_id'     => $controller_admin_address_cities_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

            // Address wards
            [
                'id'                => '46',
                'controller_id'     => $controller_admin_address_wards_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '47',
                'controller_id'     => $controller_admin_address_wards_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '48',
                'controller_id'     => $controller_admin_address_wards_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '49',
                'controller_id'     => $controller_admin_address_wards_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '50',
                'controller_id'     => $controller_admin_address_wards_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

            // Address streets
            [
                'id'                => '51',
                'controller_id'     => $controller_admin_address_streets_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '52',
                'controller_id'     => $controller_admin_address_streets_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '53',
                'controller_id'     => $controller_admin_address_streets_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '54',
                'controller_id'     => $controller_admin_address_streets_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '55',
                'controller_id'     => $controller_admin_address_streets_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

            // Address districts
            [
                'id'                => '56',
                'controller_id'     =>  $controller_admin_address_districts_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '57',
                'controller_id'     =>  $controller_admin_address_districts_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '58',
                'controller_id'     =>  $controller_admin_address_districts_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '59',
                'controller_id'     =>  $controller_admin_address_districts_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '60',
                'controller_id'     =>  $controller_admin_address_districts_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

            // Admin settings
            [
                'id'                => '61',
                'controller_id'     =>  $controller_admin_settings_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '62',
                'controller_id'     =>  $controller_admin_settings_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '63',
                'controller_id'     =>  $controller_admin_settings_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '64',
                'controller_id'     =>  $controller_admin_settings_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '65',
                'controller_id'     =>  $controller_admin_settings_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

            // Admin one many
            [
                'id'                => '66',
                'controller_id'     =>  $controller_admin_one_many_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '67',
                'controller_id'     =>  $controller_admin_one_many_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '68',
                'controller_id'     =>  $controller_admin_one_many_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '69',
                'controller_id'     =>  $controller_admin_one_many_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '70',
                'controller_id'     =>  $controller_admin_one_many_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

            // Admin files
            [
                'id'                => '71',
                'controller_id'     =>  $controller_admin_files_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '72',
                'controller_id'     =>  $controller_admin_files_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '73',
                'controller_id'     =>  $controller_admin_files_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '74',
                'controller_id'     =>  $controller_admin_files_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '75',
                'controller_id'     =>  $controller_admin_files_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

            // Admin Calendar
            [
                'id'                => '76',
                'controller_id'     =>  $controller_admin_calendar_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '77',
                'controller_id'     =>  $controller_admin_calendar_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '78',
                'controller_id'     =>  $controller_admin_calendar_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '79',
                'controller_id'     =>  $controller_admin_calendar_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '80',
                'controller_id'     =>  $controller_admin_calendar_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '81',
                'controller_id'     =>  $controller_admin_notification_id,
                'name'              => 'List',
                'key'               => 'index',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '82',
                'controller_id'     =>  $controller_admin_notification_id,
                'name'              => 'Create',
                'key'               => 'create',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '83',
                'controller_id'     =>  $controller_admin_notification_id,
                'name'              => 'Update',
                'key'               => 'edit',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '84',
                'controller_id'     =>  $controller_admin_notification_id,
                'name'              => 'View',
                'key'               => 'show',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '85',
                'controller_id'     =>  $controller_admin_notification_id,
                'name'              => 'Delete',
                'key'               => 'delete',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],
            [
                'id'                => '86',
                'controller_id'     =>  $controller_admin_notification_id,
                'name'              => 'Demo',
                'key'               => 'demo',
                'permission'        => AdminAction::PERMISSION_PRIVATE,
            ],

        ];
        AdminAction::insert($data);
    }
}
