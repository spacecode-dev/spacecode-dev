<?php

namespace SpaceCode\GoDesk\Resources;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use SpaceCode\GoDesk\AttachToRole;
use SpaceCode\GoDesk\RoleBooleanGroup;
use SpaceCode\GoDesk\Traits\Resolve;
use Spatie\Permission\PermissionRegistrar;

class Permission extends Resource
{
    use Resolve;

    /**
     * @var string
     */
    public static $model = \Spatie\Permission\Models\Permission::class;

    /**
     * @var string
     */
    public static $title = 'name';

    /**
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * @return mixed
     */
    public static function getModel()
    {
        return app(PermissionRegistrar::class)->getPermissionClass();
    }

    /**
     * @return string
     */
    public static function group(): string
    {
        return __('Permit');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public static function label()
    {
        return __('Permissions');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public static function singularLabel()
    {
        return __('Permission');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public static function createButtonLabel()
    {
        return __('Create');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public static function updateButtonLabel()
    {
        return __('Update');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Name'), 'name')
                ->rules(['required', 'string', 'max:55'])
                ->creationRules('unique:'.config('permission.table_names.permissions'))
                ->updateRules('unique:'.config('permission.table_names.permissions').',name,{{resourceId}}'),

            Select::make(__('Guard Name'), 'guard_name')
                ->options($this->guardOptions())
                ->rules(['required', Rule::in($this->guardOptions())]),

            DateTime::make(__('Created At'), 'created_at')
                ->exceptOnForms(),

            DateTime::make(__('Updated At'), 'updated_at')
                ->exceptOnForms(),

            RoleBooleanGroup::make(__('Roles'), 'roles'),

            MorphToMany::make(__('Users'), 'users', User::class)
                ->searchable()
                ->singularLabel(User::singularLabel()),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cards(Request $request): array
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function filters(Request $request): array
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request): array
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function actions(Request $request): array
    {
        return [
            new AttachToRole(),
        ];
    }
}