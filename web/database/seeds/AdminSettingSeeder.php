<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminSetting;

class AdminSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminSetting::truncate();
        $data = [
            'setting1'   => [
                'id'            => 1,
                'key'           => 'backend_theme',
                'value'         => 'basic',
                'description'   => 'Back-end theme',
                'updated'       => '2020-03-17',
            ],
            'setting2'   => [
                'id'            => 2,
                'key'           => 'backend_items_per_page',
                'value'         => '50',
                'description'   => 'Number of item page',
                'updated'       => '2020-03-17',
            ],
            'setting3'   => [
                'id'            => 3,
                'key'           => 'domain',
                'value'         => 'http://local-laravel-core.betech.com',
                'description'   => 'Domain',
                'updated'       => '2020-03-17',
            ],
            'setting4'   => [
                'id'            => 4,
                'key'           => 'language',
                'value'         => 'en-US',
                'description'   => 'Language',
                'updated'       => '2020-03-17',
            ],
            'setting5'   => [
                'id'            => 5,
                'key'           => 'frontend_theme',
                'value'         => 'jackson',
                'description'   => 'Front-end theme',
                'updated'       => '2020-03-17',
            ],
            'setting6'   => [
                'id'            => 6,
                'key'           => 'site_title',
                'value'         => 'Laravel core',
                'description'   => 'Site title',
                'updated'       => '2020-03-17',
            ],
        ];
        AdminSetting::insert($data);
    }
}
