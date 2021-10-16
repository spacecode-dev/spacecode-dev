<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Robots;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class RobotsController extends Controller
{
    /**
     * @param Robots $robots
     * @return ResponseFactory|Response
     */
    public function get(Robots $robots)
    {
        if(get_setting('hide_from_index')) {
            $robots->addUserAgent('*');
            $robots->addDisallow('/');
            $robots->addSpacer();
            $robots->addUserAgent('Googlebot');
            $robots->addDisallow('/');
            $robots->addSpacer();
            $robots->addUserAgent('Yandex');
            $robots->addDisallow('/');
            $robots->addSpacer();
            $robots->addUserAgent('Bingbot');
            $robots->addDisallow('/');
            $robots->addSpacer();
            $robots->addUserAgent('DuckDuckBot');
            $robots->addDisallow('/');
            $robots->addSpacer();
            $robots->addUserAgent('Baiduspider');
            $robots->addDisallow('/');
            $robots->addSpacer();
            $robots->addUserAgent('Slurp');
            $robots->addDisallow('/');
        } else {
            $robots->addUserAgent('*');
            $robots->addDisallow('');
            GoDesk::disallowPath()->map(function ($disallow) use($robots) {
                $robots->addDisallow("/$disallow");
            });
            if(get_setting('use_blog') && get_setting('blog_hide_tags')) {
                $prefix = get_setting('prefix_post_tag');
                $robots->addDisallow("/$prefix");
            }
            $robots->addSpacer();
            $robots->addHost(str_replace(['https://', 'http://'], '', url('/')));
            $robots->addSpacer();
            $robots->addSitemap(url('sitemap.xml'));
        }
        return response($robots->generate(), 200, ['Content-Type' => 'text/plain']);
    }
}