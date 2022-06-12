<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminOneMany;

class AdminOneManySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminOneMany::truncate();
        $data = [

        ];
        AdminOneMany::insert($data);
    }
}
