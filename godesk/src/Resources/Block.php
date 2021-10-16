<?php

namespace SpaceCode\GoDesk\Resources;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use SpaceCode\GoDesk\Layouts;
use SpaceCode\GoDesk\Traits\Resolve;
use Whitecube\NovaFlexibleContent\Flexible;

class Block extends Resource
{
    use Resolve;

    /**
     * @var string
     */
    public static $model = \SpaceCode\GoDesk\Models\Block::class;

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
        return __('Blocks');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('Block');
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
     * @throws \Exception
     */
    public function fields(Request $request)
    {
        return [

            ID::make()->asBigInt()->sortable(),

            Text::make(__('Title'), 'title')
                ->rules('required', 'max:55')
                ->creationRules('unique:templates,title')
                ->updateRules('unique:templates,title,{{resourceId}}'),

            Flexible::make(__('Content'), 'content')
                ->button(__('Add'))
                ->addLayout(Layouts\H2::class)
                ->addLayout(Layouts\H3::class)
                ->addLayout(Layouts\H4::class)
                ->addLayout(Layouts\H5::class)
                ->addLayout(Layouts\H6::class)
                ->addLayout(Layouts\Paragraph::class)
                ->addLayout(Layouts\Blockquote::class)
                ->addLayout(Layouts\Boolean::class)
                ->addLayout(Layouts\Date::class)
                ->addLayout(Layouts\DateTime::class)
                ->addLayout(Layouts\Number::class)
                ->addLayout(Layouts\Image::class)
                ->addLayout(Layouts\Color::class)
                ->addLayout(Layouts\BulletedList::class)
                ->addLayout(Layouts\NumberedList::class)
                ->addLayout(Layouts\Elements::class)
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
