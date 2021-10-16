<?php

namespace SpaceCode\GoDesk\Tools;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class FilemanagerTool extends Tool
{
    /**
     * @return void
     */
    public function boot()
    {
        Nova::script('filemanager', __DIR__ . '/../../dist/js/filemanager-tool.js');
    }

    /**
     * @return Application|Factory|View|string
     */
    public function renderNavigation()
    {
        return view('godesk::filemanager.navigation');
    }
}