<?php

namespace SpaceCode\GoDesk\Traits;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use SpaceCode\GoDesk\Fields\Toggle;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Resources\Template;

trait Field {

    /**
     * @return Select|Text
     */
    public function statusPage()
    {
        if($this->type === 'home') {
            return Text::make(__('Status'), 'status')->withMeta(['value' => __('Published')])->onlyOnForms()->readonly();
        } else {
            return Select::make(__('Status'), 'status')
                ->onlyOnForms()
                ->rules('required')
                ->options(collect($this::$model::$statuses)->mapWithKeys(function ($key) {
                    return [$key => __(ucfirst($key))];
                }));
        }
    }

    /**
     * @return BelongsTo|null
     */
    public function parentPage(): ?BelongsTo
    {
        return $this->type === 'home'
            ? null
            : BelongsTo::make(__('Parent'), 'parent', get_class($this))
                ->help($this->parent())
                ->nullable()
                ->hideFromIndex();
    }

    /**
     * @return Slug|Hidden
     */
    public function slugPage()
    {
        return $this->type === 'home'
            ? Hidden::make('slug')->withMeta(['value' => $this->slug])
            : Slug::make(__('Slug'), 'slug')
                ->from('title.' . GoDesk::adminLang())
                ->onlyOnForms()
                ->help($this->slug())
                ->rules('required', 'max:255')
                ->creationRules('unique:pages,slug')
                ->updateRules('unique:pages,slug,{{resourceId}}');
    }

    /**
     * @return Text|null
     */
    public function indexSlugPostTag(): ?Text
    {
        return !is_tag_index()
            ? null
            : Text::make(__('Url'), 'slug', function () {
                return $this->linkSvg();
            })->asHtml()->onlyOnIndex();
    }

    /**
     * @return BelongsTo|null
     */
    public function templatePostTag(): ?BelongsTo
    {
        return !is_tag_index()
            ? null
            : BelongsTo::make(__('Template'), 'template', Template::class)
                ->nullable()
                ->help($this->template())
                ->hideFromIndex();
    }

    /**
     * @return Slug|null
     */
    public function slugPostTag(): ?Slug
    {
        return !is_tag_index()
            ? null
            : Slug::make(__('Slug'), 'slug')
                ->from('title.' . GoDesk::adminLang())
                ->onlyOnForms()
                ->help($this->slug())
                ->rules('required', 'max:255')
                ->creationRules('unique:post_tags,slug')
                ->updateRules('unique:post_tags,slug,{{resourceId}}');
    }

    /**
     * @return Textarea|null
     */
    public function excerptPostTag(): ?Textarea
    {
        return !is_tag_index()
            ? null
            : Textarea::make(__('Excerpt'), 'excerpt')
                ->rules('max:255')
                ->translatable(GoDesk::websiteLangsWithNames())
                ->alwaysShow()
                ->stacked()
                ->hideFromIndex();
    }

    /**
     * @return Markdown|null
     */
    public function contentPostTag(): ?Markdown
    {
        return !is_tag_index()
            ? null
            : Markdown::make(__('Content'), 'content')
                ->translatable(GoDesk::websiteLangsWithNames())
                ->stacked()
                ->hideFromIndex();
    }

    /**
     * @return array
     */
    public function seoPostTag(): array
    {
        return !is_tag_index()
            ? []
            : array_filter([
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
                    ->translatable(GoDesk::websiteLangsWithNames())
                    ->hideFromIndex(),

                Textarea::make(__('Meta Description'), 'meta_description')
                    ->rules('max:160')
                    ->help($this->metaDescription())
                    ->translatable(GoDesk::websiteLangsWithNames())
                    ->alwaysShow()
                    ->hideFromIndex(),

                Textarea::make(__('Meta Keywords'), 'meta_keywords')
                    ->help($this->metaKeys())
                    ->translatable(GoDesk::websiteLangsWithNames())
                    ->alwaysShow()
                    ->hideFromIndex()
            ]);
    }

    /**
     * @return array
     */
    public function toggleIndex(): array
    {
        return array_filter([
            Toggle::make(__('Google'), 'index->google')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
            Toggle::make(__('Yandex'), 'index->yandex')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
            Toggle::make(__('Bing'), 'index->bing')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
            Toggle::make(__('DuckDuckGo'), 'index->duck')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
            Toggle::make(__('Baidu'), 'index->baidu')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
            Toggle::make(__('Yahoo'), 'index->yahoo')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex()
        ]);
    }

    /**
     * @return array
     */
    public function toggleIndexPostTag(): array
    {
        return !is_tag_index()
            ? []
            : array_filter([
                Toggle::make(__('Google'), 'index->google')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
                Toggle::make(__('Yandex'), 'index->yandex')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
                Toggle::make(__('Bing'), 'index->bing')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
                Toggle::make(__('DuckDuckGo'), 'index->duck')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
                Toggle::make(__('Baidu'), 'index->baidu')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex(),
                Toggle::make(__('Yahoo'), 'index->yahoo')->translatable(GoDesk::websiteLangsWithNames())->hideFromIndex()
            ]);
    }
}