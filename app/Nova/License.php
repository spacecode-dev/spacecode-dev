<?php

namespace App\Nova;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use SpaceCode\GoDesk\Resources\User;

class License extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\License::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',
    ];

    /**
     * @var array
     */
    public static $statuses = [
        'active' => 'success',
        'inactive' => 'danger',
        'deleted' => 'danger',
    ];

    /**
     * @return string
     */
    public static function group(): string
    {
        return __('Services');
    }

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('Licenses');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('License');
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
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->asBigInt()->sortable(),

            BelongsTo::make(__('Author'), 'author', User::class)
                ->rules('required'),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:licenses,name')
                ->updateRules('unique:licenses,name,{{resourceId}}'),

            Text::make(__('Series'), 'series')
                ->exceptOnForms()
                ->readonly(),

            Select::make(__('Type'), 'type')
                ->options(collect(self::$model::$types)->mapWithKeys(function ($key) {
                    return [$key => __(ucfirst($key))];
                }))
                ->sortable()
                ->rules('required', Rule::in(self::$model::$types)),

            Date::make(__('Purchased At'), 'purchased_at')
                ->sortable(),

            Select::make(__('Status'), 'status')
                ->onlyOnForms()
                ->rules('required')
                ->hideFromIndex()
                ->options(collect(self::$model::$statuses)->mapWithKeys(function ($key) {
                    return [$key => __(ucfirst($key))];
                })),

            Badge::make(__('Status'), 'status', function () {
                if ($this->isSoftDeleted()) return 'deleted';
                return $this->status;
            })->map(self::$statuses)->sortable()
                ->onlyOnIndex(),

            DateTime::make(__('Created At'), 'created_at')
                ->exceptOnForms()
                ->hideFromIndex(),

            DateTime::make(__('Updated At'), 'updated_at')
                ->exceptOnForms()
                ->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
