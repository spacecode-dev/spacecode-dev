<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Models;

class SitemapController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $sitemap = App::make('sitemap');
        if(!get_setting('hide_from_index')) {
            $homepage = Models\Page::where(['guard_name' => 'web',  'status' => 'published', 'type' => 'home']);
            $sitemap->addSitemap(URL::to('sitemap-homepage.xml'), $this->formatC($homepage));

            $pages = Models\Page::where(['guard_name' => 'web', 'status' => 'published', 'type' => 'page']);
            if($pages->count() > 0) {
                $sitemap->addSitemap(URL::to('sitemap-pages.xml'), $this->formatC($pages));
            }

            if(get_setting('use_blog')) {
                $posts = Models\Post::where(['guard_name' => 'web', 'status' => 'published']);
                if($posts->count() > 0) {
                    $sitemap->addSitemap(URL::to('sitemap-posts.xml'), $this->formatC($posts));
                }

                $postCategories = Models\PostCategory::where(['guard_name' => 'web']);
                if($postCategories->count() > 0) {
                    $sitemap->addSitemap(URL::to('sitemap-post-categories.xml'), $this->formatC($postCategories));
                }

                if(!get_setting('blog_hide_tags')) {
                    $postTags = Models\PostTag::where(['guard_name' => 'web']);
                    if($postTags->count() > 0) {
                        $sitemap->addSitemap(URL::to('sitemap-post-tags.xml'), $this->formatC($postTags));
                    }
                }
            }
            if(get_setting('use_portfolio')) {
                $portfolio = Models\Portfolio::where(['guard_name' => 'web', 'status' => 'published']);
                if($portfolio->count() > 0) {
                    $sitemap->addSitemap(URL::to('sitemap-portfolio.xml'), $this->formatC($portfolio));
                }
            }
        }
        return $sitemap->render('sitemapindex');
    }

    /**
     * @return mixed
     */
    public function home() {
        $homepage = Models\Page::where(['guard_name' => 'web', 'status' => 'published', 'type' => 'home'])->first();
        $sitemap = App::make('sitemap');
        if(GoDesk::isMultiLang()) {
            $sitemap->add($homepage->originalUrl, $homepage->updated_at->format('c'), '1.0', 'weekly', [], null, collect($homepage->locales)->filter()->map(function ($value, $key) {
                return ['language' => $key, 'url' => $value];
            })->values()->toArray());
        } else {
            $sitemap->add($homepage->originalUrl, $homepage->updated_at->format('c'), '1.0', 'weekly');
        }
        return $sitemap->render();
    }

    /**
     * @return mixed
     */
    public function pages() {
        $items = Models\Page::where(['guard_name' => 'web', 'status' => 'published', 'type' => 'page']);
        $sitemap = App::make('sitemap');
        if($items->count() > 0) {
            foreach ($items->orderBy('created_at', 'desc')->get() as $item) {
                if(GoDesk::isMultiLang()) {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '1', 'weekly', [], null, collect($item->locales)->filter()->map(function ($value, $key) {
                        return ['language' => $key, 'url' => $value];
                    })->values()->toArray());
                } else {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '1', 'weekly');
                }
            }
        }
        return $sitemap->render();
    }

    /**
     * @return mixed
     */
    public function posts() {
        $items = Models\Post::where(['guard_name' => 'web', 'status' => 'published']);
        $sitemap = App::make('sitemap');
        if($items->count() > 0) {
            foreach ($items->orderBy('created_at', 'desc')->get() as $item) {
                if(GoDesk::isMultiLang()) {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '0.7', 'daily', [], null, collect($item->locales)->filter()->map(function ($value, $key) {
                        return ['language' => $key, 'url' => $value];
                    })->values()->toArray());
                } else {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '0.7', 'daily');
                }
            }
        }
        return $sitemap->render();
    }

    /**
     * @return mixed
     */
    public function portfolio() {
        $items = Models\Portfolio::where(['guard_name' => 'web', 'status' => 'published']);
        $sitemap = App::make('sitemap');
        if($items->count() > 0) {
            foreach ($items->orderBy('created_at', 'desc')->get() as $item) {
                if(GoDesk::isMultiLang()) {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '0.7', 'daily', [], null, collect($item->locales)->filter()->map(function ($value, $key) {
                        return ['language' => $key, 'url' => $value];
                    })->values()->toArray());
                } else {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '0.7', 'daily');
                }
            }
        }
        return $sitemap->render();
    }

    /**
     * @return mixed
     */
    public function postCategories() {
        $items = Models\PostCategory::where(['guard_name' => 'web']);
        $sitemap = App::make('sitemap');
        if($items->count() > 0) {
            foreach ($items->orderBy('created_at', 'desc')->get() as $item) {
                if(GoDesk::isMultiLang()) {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '0.7', 'daily', [], null, collect($item->locales)->filter()->map(function ($value, $key) {
                        return ['language' => $key, 'url' => $value];
                    })->values()->toArray());
                } else {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '0.7', 'daily');
                }
            }
        }
        return $sitemap->render();
    }

    /**
     * @return mixed
     */
    public function postTags() {
        if(get_setting('use_blog') && get_setting('blog_hide_tags')) {
            return abort(404);
        }
        $items = Models\PostTag::where(['guard_name' => 'web']);
        $sitemap = App::make('sitemap');
        if($items->count() > 0) {
            foreach ($items->orderBy('created_at', 'desc')->get() as $item) {
                if(GoDesk::isMultiLang()) {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '0.7', 'daily', [], null, collect($item->locales)->filter()->map(function ($value, $key) {
                        return ['language' => $key, 'url' => $value];
                    })->values()->toArray());
                } else {
                    $sitemap->add($item->originalUrl, $item->updated_at->format('c'), '0.7', 'daily');
                }
            }
        }
        return $sitemap->render();
    }

    /**
     * @param $eom
     * @return mixed
     */
    public function formatC($eom) {
        return $eom->orderBy('updated_at', 'desc')->first()->updated_at->format('c');
    }
}