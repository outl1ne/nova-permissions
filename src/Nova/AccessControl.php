<?php

namespace Outl1ne\NovaPermissions\Nova;

use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Panel;
use Silvanite\Brandenburg\Role;

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
            BooleanGroup::make(__('Roles To Allow Access'), 'access_roles')
                ->resolveUsing(
                    fn ($value) => collect($value)
                        ->mapWithKeys(fn ($permission) => [$permission => true])
                        ->toArray()
                )
                ->options(
                    $options->mapWithKeys(fn ($role) => [$role->id => __($role->name)])
                        ->sort()
                        ->toArray()
                )
                ->withoutTypeCasting(),
        ];
    }
}
