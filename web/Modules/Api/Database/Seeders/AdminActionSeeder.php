<?php
namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminController;
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
        $last_admin_action = AdminAction::latest('id')->first();
        $next_id = $last_admin_action->id;
        $api_request_logs = AdminController::where([
            'name'           => 'api-request-logs',
        ])->first();
        $api_reg_requets  = AdminController::where([
            'name'           => 'api-reg-requests',
        ])->first();
        $api_tokens       = AdminController::where([
            'name'           => 'api-tokens',
        ])->first();
        $controller_api_reg_requests_id    = $api_reg_requets->id;
        $controller_api_request_logs_id    = $api_request_logs->id;
        $controller_api_tokens             = $api_tokens->id;
        if(!empty($controller_api_request_logs_id))
        {
            $data = [
                // Api request logs
                [
                    'id'                => $next_id+1,
                    'controller_id'     => $controller_api_request_logs_id,
                    'name'              => 'List',
                    'key'               => 'index',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],
                [
                    'id'                => $next_id+2,
                    'controller_id'     => $controller_api_request_logs_id,
                    'name'              => 'Delete',
                    'key'               => 'delete',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],
                [
                    'id'                => $next_id+3,
                    'controller_id'     => $controller_api_request_logs_id,
                    'name'              => 'Delete all',
                    'key'               => 'delete all',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],
                [
                    'id'                => $next_id+4,
                    'controller_id'     => $controller_api_tokens,
                    'name'              => 'List',
                    'key'               => 'index',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],       
                [
                    'id'                => $next_id+5,
                    'controller_id'     => $controller_api_tokens,
                    'name'              => 'Delete',
                    'key'               => 'delete',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],
                [
                    'id'                => $next_id+6,
                    'controller_id'     => $controller_api_tokens,
                    'name'              => 'Delete all',
                    'key'               => 'delete all',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],
            ];
        }
        AdminAction::insert($data);
        if(!empty($controller_api_reg_requests_id))
        {
            $data = [
                // Api request logs
                [
                    'id'                => $next_id+4,
                    'controller_id'     => $controller_api_reg_requests_id,
                    'name'              => 'List',
                    'key'               => 'index',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],
                [
                    'id'                => $next_id+5,
                    'controller_id'     => $controller_api_reg_requests_id,
                    'name'              => 'Delete',
                    'key'               => 'delete',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],
                [
                    'id'                => $next_id+6,
                    'controller_id'     => $controller_api_reg_requests_id,
                    'name'              => 'Delete all',
                    'key'               => 'delete all',
                    'permission'        => AdminAction::PERMISSION_PRIVATE,
                ],
            ];
        }
        AdminAction::insert($data);
    }
}
