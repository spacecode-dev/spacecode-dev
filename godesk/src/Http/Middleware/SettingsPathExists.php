<?php

namespace SpaceCode\GoDesk\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SpaceCode\GoDesk\Tools\SettingsTool;
use Symfony\Component\HttpFoundation\Response;

class SettingsPathExists
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->get('path');
        $path = !empty($path) ? trim($path) : 'general';
        return SettingsTool::doesPathExist($path) ? $next($request) : abort(404);
    }
}