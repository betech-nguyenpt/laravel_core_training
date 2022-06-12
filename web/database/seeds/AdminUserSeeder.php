<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminUser;
use Modules\Admin\Entities\AdminRole;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::truncate();
        $data = [
            [
                'id'                => '1',
                'username'          => 'superadmin',
                'email'             => 'superadmin@betech-vn.com',
                'name'              => 'Super Admin',
                'password'          => '$2y$10$ojmIfyn2A5APy464epeByehQBTOBCJPp.5s2BjE2I.GwBzlQlDoqa', // betech1111
                'role_id'           => AdminRole::ROLE_SUPER_ADMIN,
            ],
            [
                'id'                => '2',
                'username'          => 'admin',
                'email'             => 'admin@betech-vn.com',
                'name'              => 'Admin',
                'password'          => '$2y$10$ojmIfyn2A5APy464epeByehQBTOBCJPp.5s2BjE2I.GwBzlQlDoqa', // betech1111
                'role_id'           => AdminRole::ROLE_ADMIN,
            ],
        ];
        AdminUser::insert($data);
    }
}
