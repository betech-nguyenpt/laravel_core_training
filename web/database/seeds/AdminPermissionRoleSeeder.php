<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminPermissionRole;

class AdminPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminPermissionRole::truncate();
        $data = [
            [
                'id'                 => '1',
                'role_id'            => '2',
                'controller_id'      => '4',
                'actions'            => 'index,create,edit,delete',
            ],
            [
                'id'                 => '2',
                'role_id'            => '2',
                'controller_id'      => '7',
                'actions'            => 'index,create,edit,delete,authorization',
            ],
            [
                'id'                 => '4',
                'role_id'            => '2',
                'controller_id'      => '11',
                'actions'            => 'index,create,edit,show,delete',
            ],
        ];
        AdminPermissionRole::insert($data);
    }
}
