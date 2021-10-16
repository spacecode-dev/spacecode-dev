<?php

namespace SpaceCode\GoDesk\Resources;

use Laravel\Nova\Fields\KeyValue;
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
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Resource;
use SpaceCode\GoDesk\Fields\FilemanagerField;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Traits\Field;
use SpaceCode\GoDesk\Traits\Help;
use SpaceCode\GoDesk\Traits\Resolve;

class Portfolio extends Resource
{
    use TabsOnEdit, Resolve, Help, Field;

    /**
     * @var string
     */
    public static $model = \SpaceCode\GoDesk\Models\Portfolio::class;

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
     * @var array
     */
    public static $statuses = [
        'pending' => 'warning',
        'published' => 'success',
        'deleted' => 'danger'
    ];

    /**
     * @return string
     */
    public static function group(): string
    {
        return __('Portfolio');
    }

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('Portfolio');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('Portfolio');
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
     * @return string
     */
    public static function uriKey()
    {
        return 'portfolio';
    }

    /**
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        $langs = GoDesk::websiteLangsWithNames();
        return array_filter([

            /**
             * Index
             */
            ID::make()->asBigInt()->sortable()->onlyOnIndex(),

            FilemanagerField::make(__('Thumbnail'), 'image')
                ->displayAsImage()->onlyOnIndex(),

            BelongsTo::make(__('Author'), 'author', User::class)->sortable()->onlyOnIndex(),

            Text::make(__('Title'), GoDesk::translatableAttribute('title'))
                ->sortable()
                ->onlyOnIndex(),

            Text::make(__('Url'), 'slug', function () {
                return $this->linkSvg();
            })->asHtml()->onlyOnIndex(),

            Text::make(__('Updated At'), 'updated_at')
                ->onlyOnIndex()
                ->sortable()
                ->displayUsing(function($date) {
                    return $date->diffForHumans();
                }),

            Badge::make(__('Status'), 'status', function ($status) {
                if ($this->isSoftDeleted()) return 'deleted';
                return $status;
            })->map(self::$statuses)
                ->labels($this->statusOptions(self::$statuses))
                ->sortable()
                ->onlyOnIndex(),

            /**
             * Form
             */
            (new Tabs($this->singularLabel(), [
                __('General') => array_filter([
                    ID::make()->asBigInt()->sortable()->hideFromIndex(),

                    FilemanagerField::make(__('Thumbnail'), 'image')
                        ->displayAsImage()->hideFromIndex(),

                    Select::make(__('Guard Name'), 'guard_name')
                        ->options($this->guardOptions())
                        ->rules('required', Rule::in($this->guardOptions()))
                        ->hideFromIndex(),

                    BelongsTo::make(__('Author'), 'author', User::class)
                        ->rules('required')
                        ->hideFromIndex()
                        ->sortable(),

                    BelongsTo::make(__('Template'), 'template', Template::class)
                        ->nullable()
                        ->help($this->template())
                        ->hideFromIndex(),

                    Select::make(__('Status'), 'status')
                        ->onlyOnForms()
                        ->rules('required')
                        ->options(collect($this::$model::$statuses)->mapWithKeys(function ($key) {
                            return [$key => __(ucfirst($key))];
                        }))
                ]),
                __('Content') => array_filter([
                    Text::make(__('Name'), 'title')
                        ->rules('required', 'max:255')
                        ->help($this->name())
                        ->translatable($langs)
                        ->hideFromIndex(),

                    Slug::make(__('Slug'), 'slug')
                        ->from('title.' . GoDesk::adminLang())
                        ->onlyOnForms()
                        ->help($this->slug())
                        ->rules('required', 'max:255')
                        ->creationRules('unique:portfolio,slug')
                        ->updateRules('unique:portfolio,slug,{{resourceId}}'),

                    Textarea::make(__('Excerpt'), 'excerpt')
                        ->rules('max:255')
                        ->translatable($langs)
                        ->alwaysShow()
                        ->stacked()
                        ->hideFromIndex(),

                    Markdown::make(__('Content'), 'content')
                        ->translatable($langs)
                        ->stacked()
                        ->hideFromIndex(),

                    DateTime::make(__('Created At'), 'created_at')
                        ->exceptOnForms()
                        ->hideFromIndex(),

                    DateTime::make(__('Updated At'), 'updated_at')
                        ->exceptOnForms()
                        ->hideFromIndex(),
                ]),
                __('Seo Fields') => array_filter([
                    Select::make(__('Document State'), 'document_state')
                        ->options($this->stateOptions())
                        ->displayUsingLabels()
                        ->rules('required')
                        ->help($this->documentState())
                        ->hideFromIndex(),

                    Heading::make(get_variables_text())->asHtml()->onlyOnForms(),

                    Text::make(__('Title'), 'meta_title')
                        ->rules('max:60')
                        ->help($this->metaTitle())
                        ->translatable($langs)
                        ->hideFromIndex(),

                    Textarea::make(__('Meta Description'), 'meta_description')
                        ->rules('max:160')
                        ->help($this->metaDescription())
                        ->translatable($langs)
                        ->alwaysShow()
                        ->hideFromIndex(),

                    Textarea::make(__('Meta Keywords'), 'meta_keywords')
                        ->help($this->metaKeys())
                        ->translatable($langs)
                        ->alwaysShow()
                        ->hideFromIndex()
                ]),
                __('Indexing') => $this->toggleIndex(),
                __('Attributes') => [
                    KeyValue::make(__('Attributes'), 'variables')
                        ->keyLabel(__('Key'))
                        ->valueLabel(__('Value'))
                        ->actionText(__('Add'))
                        ->rules('json')
                        ->hideFromIndex()
                ]
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
