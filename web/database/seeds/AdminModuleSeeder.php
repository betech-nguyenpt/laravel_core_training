<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminModule;

class AdminModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminModule::truncate();
        $data = [
            [
                'id'            => '1',
                'name'          => 'admin',
                'description'   => 'Admin module',
            ],
            [
                'id'            => '2',
                'name'          => 'api',
                'description'   => 'Api module',
            ],
        ];
        AdminModule::insert($data);
    }
}
