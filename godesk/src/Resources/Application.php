<?php

namespace SpaceCode\GoDesk\Resources;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Resource;
use SpaceCode\GoDesk\Traits\Resolve;
use Jeffbeltran\SanctumTokens\SanctumTokens;

class Application extends Resource
{
    use Resolve;

    /**
     * @var string
     */
    public static $model = \SpaceCode\GoDesk\Models\Application::class;

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
     * @return string
     */
    public static function group()
    {
        return __('Permit');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public static function label()
    {
        return __('Applications');
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public static function singularLabel()
    {
        return __('Application');
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
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make(__('Author'), 'author', User::class)->sortable()->onlyOnIndex(),

            Select::make(__('Guard Name'), 'guard_name')
                ->options($this->guardOptions())
                ->rules(['required', Rule::in($this->guardOptions())]),

            Text::make(__('Name'), 'name')
                ->exceptOnForms(),

            SanctumTokens::make(),

            DateTime::make(__('Created At'), 'created_at')
                ->exceptOnForms(),

            DateTime::make(__('Updated At'), 'updated_at')
                ->exceptOnForms(),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}