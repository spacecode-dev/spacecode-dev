<?php

namespace SpaceCode\GoDesk\Tools;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use SpaceCode\GoDesk\Resources;

class NovaTool extends Tool
{
    public function boot()
    {
        Nova::resources(collect([
            [
                Resources\ContactForm::class,
                Resources\User::class,
                Resources\Role::class,
                Resources\Permission::class,
                Resources\Application::class,
                Resources\Page::class,
                Resources\Template::class,
                Resources\Block::class
            ],
            get_setting('use_blog') ? [
                Resources\Post::class,
                Resources\PostTag::class,
                Resources\PostCategory::class
            ] : [],
            get_setting('use_portfolio') ? [
                Resources\Portfolio::class
            ] : [],
        ])->collapse()->toArray());
    }
}
