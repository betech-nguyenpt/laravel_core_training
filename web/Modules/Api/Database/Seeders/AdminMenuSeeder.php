<?php
namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminMenu;
use Modules\Admin\Entities\AdminController;
use Modules\Admin\Entities\AdminAction;
use Modules\Admin\Entities\AdminModule;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_modules = AdminModule::where([
            'name'           => 'api',
        ])
        ->first();
        
        $admin_controllers = AdminController::where([
            'module_id'           => $admin_modules->id,
        ])
        ->get();
        foreach ($admin_controllers as $admin_controller ) {
            $last_menu = AdminMenu::latest('id')->first();
            $next_id = $last_menu->id;
            $api_menu_parent = AdminMenu::where([
                'name'           => 'Api',
            ])->first();
            
            $admin_action = AdminAction::where([
                'key'           => 'index',
                'controller_id' => $admin_controller ->id,
            ])->first();
            $last_menu_display = AdminMenu::where([
                'parent_id'           => $api_menu_parent->id,
            ])->orderBy('display_order','desc')->first();
            
            $data = [
                [
                    'id' => $next_id+1,
                    'action_id' => $admin_action->id,
                    'view' => '',
                    'link' => '',
                    'icon' => '',
                    'icon_thumb' => '',
                    'display_order' => empty($last_menu_display->display_order)? 1 : $last_menu_display->display_order,
                    'name' => $admin_controller->description,
                    'type' => AdminMenu::TYPE_BACK_END,
                    'parent_id' => $api_menu_parent->id,
                ],
            ];
            AdminMenu::insert($data);
    }
    }
}
