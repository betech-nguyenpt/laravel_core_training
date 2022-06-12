<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Modules\Admin\Entities\AdminModule;
use Modules\Admin\Entities\AdminLogger;
use Illuminate\Database\QueryException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Define all rules
        try {
            $modules = AdminModule::loadItems();
            foreach ($modules as $module) {
                $controllers = $module->getListControllers();
                foreach ($controllers as $controller) {
                    $actions = $controller->getListActions();
                    foreach ($actions as $action) {
                        Gate::define($action->getFullname(), function($user, $action) {
                            if ($action) {
                                return $action->canAccess($user);
                            }
                            return false;
                        });
                    }
                }
            }
        } catch (QueryException $ex) {
            return false;
        }
    }
}
