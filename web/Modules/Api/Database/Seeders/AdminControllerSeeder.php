<?php
namespace Modules\Api\Database\Seeders;

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
        $last_admin_controller = AdminController::latest('id')->first();
        $next_id = $last_admin_controller->id;
        
        $data = [
            [
                'id'            => $next_id + 1,
                'name'          => 'api-request-logs',
                'module_id'     => '2',
                'description'   => 'Api request logs',
            ],
            [
                'id'            => $next_id + 2,
                'name'          => 'api-reg-requests',
                'module_id'     => '2',
                'description'   => 'Api reg requests',
            ],
            [
                'id'            => $next_id + 3,
                'name'          => 'api-tokens',
                'module_id'     => '2',
                'description'   => 'Api tokens',
            ]
            
        ];
        AdminController::insert($data);
    }
}
