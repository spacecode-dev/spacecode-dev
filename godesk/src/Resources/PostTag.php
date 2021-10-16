<?php

namespace SpaceCode\GoDesk\Resources;

use SpaceCode\GoDesk\Fields\Tabs;
use SpaceCode\GoDesk\Traits\TabsOnEdit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Resource;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Traits\Field;
use SpaceCode\GoDesk\Traits\Help;
use SpaceCode\GoDesk\Traits\Resolve;

class PostTag extends Resource
{
    use TabsOnEdit, Resolve, Help, Field;

    /**
     * @var string
     */
    public static $model = \SpaceCode\GoDesk\Models\PostTag::class;

    /**
     * @var string
     */
    public static $title = 'title';

    /**
     * @var array
     */
    public static $search = [
        'slug', 'title',
    ];

    /**
     * @return string
     */
    public function title()
    {
        return $this->{static::$title}[GoDesk::adminLang()];
    }

    /**
     * @return string
     */
    public static function group(): string
    {
        return __('Blog');
    }

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('Post Tags');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('Post Tag');
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
        return array_filter([

            /**
             * Index
             */
            ID::make()->asBigInt()->sortable()->onlyOnIndex(),

            Text::make(__('Title'), GoDesk::translatableAttribute('title'))->sortable()->onlyOnIndex(),

            $this->indexSlugPostTag(),

            Text::make(__('Updated At'), 'updated_at')
                ->onlyOnIndex()
                ->sortable()
                ->displayUsing(function($date) {
                    return $date->diffForHumans();
                }),

            /**
             * Form
             */
            (new Tabs($this->singularLabel(), [
                __('General') => array_filter([
                    ID::make()->asBigInt()->sortable()->hideFromIndex(),

                    Select::make(__('Guard Name'), 'guard_name')
                        ->options($this->guardOptions())
                        ->rules('required', Rule::in($this->guardOptions()))
                        ->hideFromIndex(),

                    $this->templatePostTag(),
                ]),
                __('Content') => array_filter([
                    Text::make(__('Name'), 'title')
                        ->rules('required', 'max:255')
                        ->help($this->name())
                        ->translatable(GoDesk::websiteLangsWithNames())
                        ->hideFromIndex(),

                    $this->slugPostTag(),

                    $this->excerptPostTag(),

                    $this->contentPostTag(),

                    DateTime::make(__('Created At'), 'created_at')
                        ->exceptOnForms()
                        ->hideFromIndex(),

                    DateTime::make(__('Updated At'), 'updated_at')
                        ->exceptOnForms()
                        ->hideFromIndex(),
                ]),
                __('Seo Fields') => $this->seoPostTag(),
                __('Indexing') => $this->toggleIndexPostTag()
            ]))->withToolbar()
        ]);
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
