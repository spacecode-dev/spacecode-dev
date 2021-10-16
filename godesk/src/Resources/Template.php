<?php

namespace SpaceCode\GoDesk\Resources;

use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Laravel\Nova\Fields\Code;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use SpaceCode\GoDesk\Fields\Toggle;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Traits\Resolve;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;
use Whitecube\NovaFlexibleContent\Flexible;

class Template extends Resource
{
    use Resolve, HasFlexible;

    /**
     * @var string
     */
    public static $model = \SpaceCode\GoDesk\Models\Template::class;

    /**
     * @var string
     */
    public static $title = 'title';

    /**
     * @var array
     */
    public static $search = [
        'title',
    ];

    /**
     * @return string
     */
    public static function group(): string
    {
        return __('Other');
    }

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('Templates');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('Template');
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

            ID::make()->asBigInt()->sortable(),

            Text::make(__('Title'), 'title')
                ->rules('required', 'max:55')
                ->creationRules('unique:templates,title')
                ->updateRules('unique:templates,title,{{resourceId}}'),

            Toggle::make(__('Use blocks'), 'use_blocks')->stacked(),

            NovaDependencyContainer::make([
                Code::make(__('Content'), 'content')
                    ->translatable(GoDesk::websiteLangsWithNames())
                    ->language('php')
                    ->height(1000)
                    ->stacked()
            ])->dependsOnNullOrZero('use_blocks'),

            NovaDependencyContainer::make([
                Flexible::make(__('Blocks'), 'blocks')
                    ->addLayout(__('Block'), 'block', [
                        Select::make(__('Title'), 'title')
                            ->options(\SpaceCode\GoDesk\Models\Block::all()->pluck('title', 'id'))
                    ])
            ])->dependsOn('use_blocks', '1'),
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
