<?php

namespace Outl1ne\NovaPermissions\Nova;

use Laravel\Nova\Panel;
use Silvanite\Brandenburg\Role;
use Outl1ne\NovaFieldCheckboxes\Checkboxes;

class AccessControl
{
    public static function make($additionalFields = [])
    {
        return new Panel(__('Access Control'), array_merge(self::fields(), $additionalFields));
    }

    public static function fields()
    {
        $options = collect(Role::all()->filter(function ($value) {
            return $value->hasPermission('canBeGivenAccess');
        }));

        if (!$options->count()) return [];

        return [
            Checkboxes::make(__('Roles To Allow Access'), 'access_roles')->options(
                $options->mapWithKeys(fn ($role) => [$role->id => __($role->name)])
                    ->sort()
                    ->toArray()
            )
                ->withoutTypeCasting(),
        ];
    }
}
