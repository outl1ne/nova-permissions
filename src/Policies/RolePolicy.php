<?php

namespace Outl1ne\NovaPermissions\Policies;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny($user)
    {
        return Gate::any(['viewRoles', 'manageRoles'], $user);
    }

    public function view($user, $resource)
    {
        return Gate::any(['viewRoles', 'manageRoles'], $user);
    }

    public function create($user, $resource)
    {
        return $user->can('manageRoles');
    }

    public function update($user, $resource)
    {
        return $user->can('manageRoles');
    }

    public function delete($user, $resource)
    {
        return $user->can('manageRoles');
    }

    public function restore($user, $resource)
    {
        return $user->can('manageRoles');
    }

    public function forceDelete($user, $resource)
    {
        return $user->can('manageRoles');
    }

    public function attachAnyUser($user, $resource)
    {
        return Gate::any(['assignRoles', 'manageRoles'], $user);
    }

    public function detachAnyUser($user, $resource)
    {
        return $user->can('manageRoles');
    }
}
