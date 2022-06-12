<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Observers\ModelObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        \Modules\Admin\Entities\AdminModule::observe(ModelObserver::class);
        \Modules\Admin\Entities\AdminController::observe(ModelObserver::class);
        \Modules\Admin\Entities\AdminAction::observe(ModelObserver::class);
        \Modules\Admin\Entities\AdminMenu::observe(ModelObserver::class);
        \Modules\Admin\Entities\AdminRole::observe(ModelObserver::class);
        \Modules\Admin\Entities\AdminUser::observe(ModelObserver::class);
        \Modules\Admin\Entities\AdminAutoEmail::observe(ModelObserver::class);
    }
}
