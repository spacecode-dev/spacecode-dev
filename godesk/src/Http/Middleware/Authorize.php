<?php

namespace SpaceCode\GoDesk\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SpaceCode\GoDesk\Tools\FilemanagerTool;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        return app(FilemanagerTool::class)->authorize($request) ? $next($request) : abort(403);
    }
}