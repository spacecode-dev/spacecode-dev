<?php

namespace App\Nova;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;

class Release extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Release::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'version',
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
        return __('Releases');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('Release');
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

            Number::make(__('Version'), 'version')
                ->creationRules('unique:releases,version')
                ->updateRules('unique:releases,version,{{resourceId}}')
                ->min(1)
                ->max(99)
                ->step(0.01),

            File::make(__('Link'), 'link')
                ->creationRules('required')
                ->disk('private')
                ->deletable(false)
                ->prunable(),

            Code::make(__('Content'), 'content')->language('php'),

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
