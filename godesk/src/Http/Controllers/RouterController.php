<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class RouterController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        return view('godesk::router', [
            'user' => $request->user(),
        ]);
    }
}
