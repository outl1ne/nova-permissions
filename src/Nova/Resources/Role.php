<?php

namespace Outl1ne\NovaPermissions\Nova\Resources;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Silvanite\Brandenburg\Policy;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\BelongsToMany;

class Role extends Resource
{
    public static $model = \Silvanite\Brandenburg\Role::class;
    public static $title = 'name';

    public static $search = [
        'id',
        'slug',
        'name',
    ];

    public static $with = [
        'users',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Name'), 'name')->sortable(),

            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->rules('required')
                ->creationRules('unique:roles')
                ->updateRules('unique:roles,slug,{{resourceId}}')
                ->sortable(),

            BooleanGroup::make(__('Permissions'), 'permissions')
                ->resolveUsing(
                    fn ($value) => collect($value)
                        ->mapWithKeys(fn ($permission) => [$permission => true])
                        ->toArray()
                )
                ->fillUsing(function ($request, $model, $attribute) {
                    $permissions = json_decode($request->{$attribute} ?? '[]', true) ?? [];
                    $permissions = collect($permissions)->filter(fn ($p) => !!$p)->keys()->toArray();
                    $model->{$attribute} = $permissions;
                })
                ->options(
                    collect(Policy::all())
                        ->mapWithKeys(fn ($policy) => [$policy => __($policy)])
                        ->sort()
                        ->toArray()
                ),

            Text::make(__('Users'), function () {
                return count($this->users);
            })->onlyOnIndex(),

            BelongsToMany::make(__('Users'), 'users', config('nova-permissions.userResource', 'App\Nova\User'))
                ->searchable(),
        ];
    }

    public static function group()
    {
        return __(config('nova-permissions.roleResourceGroup', static::$group));
    }

    public static function label()
    {
        return __('Roles');
    }

    public static function singularLabel()
    {
        return __('Role');
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
