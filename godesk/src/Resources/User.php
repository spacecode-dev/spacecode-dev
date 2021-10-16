<?php

namespace SpaceCode\GoDesk\Resources;

use App\Nova\Resource;
use SpaceCode\GoDesk\Fields\Tabs;
use SpaceCode\GoDesk\Traits\TabsOnEdit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\PasswordConfirmation;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use SpaceCode\GoDesk\Fields\FilemanagerField;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\RoleBooleanGroup;

class User extends Resource
{
    use TabsOnEdit;

    /**
     * @var string
     */
    public static $model = \SpaceCode\GoDesk\Models\User::class;

    /**
     * @var string
     */
    public static $title = 'name';

    /**
     * @return string
     */
    public static function group(): string
    {
        return __('Other');
    }

    /**
     * @return string
     */
    public static function label(): string
    {
        return __('Users');
    }

    /**
     * @return string
     */
    public static function singularLabel(): string
    {
        return __('User');
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
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            (new Tabs($this->singularLabel(), [
                __('General') => [
                    ID::make()->asBigInt()->sortable(),

                    RoleBooleanGroup::make(__('Roles'), 'roles')->onlyOnIndex(),

                    FilemanagerField::make(__('Avatar'), 'avatar')
                        ->displayAsImage(),

                    Select::make(__('Interface Language'), 'lang')
                        ->hideFromIndex()
                        ->rules('required')
                        ->options(collect(config('godesk.langs'))->mapWithKeys(function ($value, $key) {
                            return [$value => GoDesk::localeValue($value)];
                        })),

                    Text::make(__('Name'), 'name')
                        ->rules('required', 'max:55'),

                    Text::make(__('Email'), 'email')
                        ->sortable()
                        ->rules('required', 'max:255', 'email', function ($attribute, $value, $fail) {
                            if (strtolower($value) !== $value) {
                                return __('The email field must be lowercase.');
                            }
                        })->creationRules('unique:users,email')
                        ->updateRules('unique:users,email,{{resourceId}}'),

                    DateTime::make(__('Created At'), 'created_at')
                        ->format('DD MMM YYYY, HH:mm')
                        ->exceptOnForms()
                        ->hideFromIndex(),

                    DateTime::make(__('Updated At'), 'updated_at')
                        ->format('DD MMM YYYY, HH:mm')
                        ->exceptOnForms()
                        ->hideFromIndex()
                ],
                __('Security') => [
                    Password::make(__('Password'), 'password')
                        ->onlyOnForms()
                        ->creationRules('required', 'string', 'min:8', 'max:55')
                        ->updateRules('nullable', 'string', 'min:8', 'max:55'),

                    PasswordConfirmation::make(__('Password Confirmation')),
                ],
                __('Roles and Permissions') => [
                    MorphToMany::make(__('Roles'), 'roles', Role::class),
                    MorphToMany::make(__('Permissions'), 'permissions', Permission::class),
                ],
            ]))->withToolbar()->defaultSearch(true),

            DateTime::make(__('Created At'), 'created_at')
                ->format('DD MMM YYYY, HH:mm')
                ->onlyOnIndex()
                ->sortable(),

            DateTime::make(__('Updated At'), 'updated_at')
                ->format('DD MMM YYYY, HH:mm')
                ->onlyOnIndex()
                ->sortable()
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
        return [];
    }


}
