<?php

namespace Outl1ne\NovaPermissions\Policies;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny($user)
    {
        return Gate::any(['viewUsers', 'manageUsers'], $user);
    }

    public function view($user, $resource)
    {
        return Gate::any(['viewUsers', 'manageUsers'], $user);
    }

    public function create($user)
    {
        return $user->can('manageUsers');
    }

    public function update($user, $resource)
    {
        return $user->can('manageUsers');
    }

    public function delete($user, $resource)
    {
        return $user->can('manageUsers');
    }

    public function restore($user, $resource)
    {
        return $user->can('manageUsers');
    }

    public function forceDelete($user, $resource)
    {
        return $user->can('manageUsers');
    }

    public function attachAnyRole($user, $resource)
    {
        return Gate::any(['assignRoles', 'manageRoles'], $user);
    }
}
