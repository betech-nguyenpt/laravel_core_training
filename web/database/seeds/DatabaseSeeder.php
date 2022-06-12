<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data?')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");
        }
        $this->call(AdminModuleSeeder::class);
        $this->call(AdminControllerSeeder::class);
        $this->call(AdminActionSeeder::class);
        $this->call(AdminMenuSeeder::class);
        $this->call(AdminRoleSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(AdminPermissionRoleSeeder::class);
        $this->call(AdminAddressCitySeeder::class);
        $this->call(AdminAddressWardSeeder::class);
        $this->call(AdminAddressNationSeeder::class);
        $this->call(AdminAddressDistrictSeeder::class);
        $this->call(AdminAddressStreetSeeder::class);
        $this->call(AdminSettingSeeder::class);
        $this->call(AdminOneManySeeder::class);
        // Api seed
        if ($this->command->confirm('Do you wish to run Api seeder?')) {
            // Call the php artisan module:seed Api
            $this->command->call('module:seed', ['Api']);
            $this->command->warn("Begin Api seeder:");
        }
    }
}
