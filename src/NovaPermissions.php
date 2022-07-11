<?php

namespace Outl1ne\NovaPermissions;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Illuminate\Http\Request;
use Outl1ne\NovaPermissions\Nova\Resources\Role;

class NovaPermissions extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            Role::class,
        ]);
    }

    public function menu(Request $request)
    {
        return [];
    }
}
