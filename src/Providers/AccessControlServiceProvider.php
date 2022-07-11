<?php

namespace Outl1ne\NovaPermissions\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Outl1ne\NovaPermissions\Traits\AccessControlGate;

class AccessControlServiceProvider extends ServiceProvider
{
    use AccessControlGate;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('accessControl', function ($user = null, $model = null) {
            $this->accessContent($user, $model);
        });
    }
}
