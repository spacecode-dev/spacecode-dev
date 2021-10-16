<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Models;
use Illuminate\Support\Facades\View;
use SpaceCode\GoDesk\Models\Settings;
use SpaceCode\GoDesk\Traits\Resolve;
use stdClass;

class IndexController extends Controller
{
    use Resolve;

    /**
     * IndexController constructor.
     * @param $settings
     */
    public function __construct($settings = false)
    {
        if (!$settings)
            $settings = collect();
        $settings->put('tracking', (object)[
            'gtm' => get_setting('tracking_gtm'),
            'fb' => get_setting('tracking_fb'),
            'linkedin' => get_setting('tracking_linkedin'),
        ]);
        $settings->put('author', (object)[
            'title' => 'SpaceCode',
            'link' => 'https://spacecode.dev'
        ]);
        $settings->put('me', url(''));
        $settings->put('favicon', null);
        $favicon = get_setting('website_favicon');
        if ($favicon) {
            $settings->put('favicon', "<!-- Favicon -->\n\t<link rel='icon' sizes='180x180' href='" . get_favicon($favicon, '180') . "' />\n\t<link rel='icon' sizes='32x32' href='" . get_favicon($favicon, '32') . "' />\n\t<!-- End Favicon -->\n\n");
        }
        View::share('settings', (object)$settings->toArray());
    }

    /**
     * @param $slug
     * @return object
     */
    public function index($slug): object
    {
        $request = request();

        /* Get prefix from segment */
        $prefix = $this->getRequestPrefix($request);
        $lang = app()->getLocale();

        $valuePrefix = get_setting('prefix_' . $prefix);
        $slug = collect(explode('/', $slug))->filter(function($el) use($lang, $valuePrefix) {
            return $el !== $lang && $el !== $valuePrefix;
        })->filter()->values();

        if($prefix === 'page') {
            $entity = $this->pageIndex($slug);
        } else if ($prefix === 'post') {
            $entity = $this->postIndex($slug);
        } else if ($prefix === 'post_tag') {
            $entity = $this->postTagIndex($slug);
        } else if ($prefix === 'post_category') {
            $entity = $this->postCategoryIndex($slug);
        } else if ($prefix === 'portfolio') {
            $entity = $this->portfolioIndex($slug);
        } else {
            return abort(404);
        }
        $entity->locale = $lang;
        $entity->indexType = $prefix;
        if($entity->template && $entity->template->use_blocks) {
            $entity->content = collect($entity->template->flexible('blocks')->map(function ($layout) use($lang) {
                $content = Models\Block::find($layout->title)->flexible('content');
                return $content->map(function($block) use($lang) {
                    if(isset($block->elements)) {
                        return [
                            $block->name => [
                                'tag' => $block->name(),
                                'array' => collect($block->elements)->map(function ($element) use($lang) {
                                    return collect($element->attributes->fields)->map(function ($field) use($lang) {
                                        $attr = $field->attributes;
                                        if($field->layout === 'image') {
                                            return [$attr->name => ['tag' => $field->layout, 'src' => $attr->src, 'alt' => $attr->alt->{$lang}]];
                                        } else if ($field->layout === 'ol' || $field->layout === 'ul') {
                                            return [$attr->name => ['tag' => $field->layout, 'array' => collect($attr->items)->map(function ($li) use($lang) {
                                                return [$li->attributes->value->{$lang}];
                                            })->collapse()->toArray()]];
                                        } else {
                                            return [$attr->name => ['tag' => $field->layout, 'value' => is_string($attr->value) ? $attr->value : $attr->value->{$lang}]];
                                        }
                                    })->collapse()->toArray();
                                })->toArray()
                            ]
                        ];
                    } else {
                        return [$block->name => ['tag' => $block->name(), 'value' => $block->value->{$lang}]];
                    }
                })->collapse()->toArray();
            }))[0];
            $entity->content = json_decode(json_encode($entity->content));
        }
        return $entity->translateMutator();
    }

    /**
     * @param $title
     * @param $classes
     * @param $view
     * @return stdClass
     */
    public function customIndex($title, $classes, $view): stdClass
    {
        $entity = new stdClass();
        $entity->locale = app()->getLocale();
        $entity->index = null;
        $entity->indexType = 'custom';
        $entity->indexClasses = $classes;
        $entity->title = $title;
        $entity->indexView = $view;
        return $entity;
    }

    /**
     * @param $slug
     * @return object
     */
    private function pageIndex($slug): object
    {
        if(!$slug->count()) {
            $entity = Models\Page::where(['type' => 'home', 'guard_name' => 'web', 'status' => 'published'])->firstOrFail();
        } elseif ($slug->count() === 1) {
            $entity = Models\Page::whereSlug($slug->first())->where(['type' => 'page', 'guard_name' => 'web', 'status' => 'published'])->firstOrFail();
        } else {
            $entity = Models\Page::whereSlug($slug->last())->where(['type' => 'page', 'guard_name' => 'web', 'status' => 'published'])->firstOrFail();
        }
        $entity->indexModel = Models\Page::class;
        $entity->indexView = $this->getIndexView($entity);
        return $entity;
    }

    /**
     * @param $slug
     * @return object
     */
    private function postIndex($slug): object
    {
        $entity = Models\Post::whereSlug($slug)->where(['guard_name' => 'web', 'status' => 'published'])->firstOrFail();
        $entity->indexModel = Models\Post::class;
        $entity->indexView = $this->getIndexView($entity);
        return $entity;
    }

    /**
     * @param $slug
     * @return object
     */
    private function portfolioIndex($slug): object
    {
        $entity = Models\Portfolio::whereSlug($slug)->where(['guard_name' => 'web', 'status' => 'published'])->firstOrFail();
        $entity->indexModel = Models\Portfolio::class;
        $entity->indexView = $this->getIndexView($entity);
        return $entity;
    }

    /**
     * @param $slug
     * @return object
     */
    private function postTagIndex($slug): object
    {
        if(get_setting('blog_hide_tags')) {
            return abort(404);
        }
        $entity = Models\PostTag::whereSlug($slug)->where(['guard_name' => 'web'])->firstOrFail();
        $entity->indexModel = Models\PostTag::class;
        $entity->indexView = $this->getIndexView($entity);
        return $entity;
    }

    /**
     * @param $slug
     * @return object
     */
    private function postCategoryIndex($slug): object
    {
        if ($slug->count() === 1) {
            $entity = Models\PostCategory::whereSlug($slug->first())->where(['guard_name' => 'web'])->firstOrFail();
        } else {
            $entity = $slug->reduce(function ($item, $s) {
                return ($item->children()->where('slug', $s)->firstOrFail());
            }, Models\PostCategory::whereSlug($slug)->where(['guard_name' => 'web'])->with('children')->firstOrFail());
        }
        $entity->indexModel = Models\PostCategory::class;
        $entity->indexView = $this->getIndexView($entity);
        return $entity;
    }

    /**
     * @param $request
     * @return string|string[]
     */
    public function getRequestPrefix($request)
    {
        $prefixes = Settings::where('key', 'LIKE', 'prefix_%');
        if(GoDesk::isMultiLang()) {
            if(in_array($request->segment(1), get_setting('website_langs'))) {
                if($request->segment(3) && in_array($request->segment(2), $prefixes->pluck('value', 'key')->values()->toArray())) {
                    return str_replace('prefix_', '', $prefixes->where('value', $request->segment(2))->pluck('key')->first());
                }
            } else {
                if($request->segment(2) && in_array($request->segment(1), $prefixes->pluck('value', 'key')->values()->toArray())) {
                    return str_replace('prefix_', '', $prefixes->where('value', $request->segment(1))->pluck('key')->first());
                }
            }
//            $segment = in_array($request->segment(1), get_setting('website_langs')) ? $request->segment(2) : $request->segment(1);
//            if(in_array($segment, $prefixes->pluck('value', 'key')->values()->toArray())) {
//                return str_replace('prefix_', '', $prefixes->where('value', $segment)->pluck('key')->first());
//            }
        } else {
            if($request->segment(2) && in_array($request->segment(1), $prefixes->pluck('value', 'key')->values()->toArray())) {
                return str_replace('prefix_', '', $prefixes->where('value', $request->segment(1))->pluck('key')->first());
            }
        }
        return 'page';
    }

    /**
     * @param $entity
     * @return string
     */
    private function getIndexView($entity): string
    {
        return !$entity->template_id ? 'godesk::index.templates.content' : 'godesk-index::templates.' . Str::of($entity->template->title)->slug('-') . '.' . app()->getLocale();
    }
}