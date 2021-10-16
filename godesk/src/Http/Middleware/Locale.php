<?php

namespace SpaceCode\GoDesk\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SpaceCode\GoDesk\GoDesk;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $this->getRequestLang($request);
        app()->setLocale($lang);
        if($this->isProfile($request)) {
            session()->put('lang', $lang);
        } else if (session()->has('lang')) {
            session()->forget('lang');
        }
        return $next($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    private function getRequestLang($request)
    {
        if($this->isProfile($request)) {
            // Profile
            if(auth()->check()) {
                return $request->user()->lang;
            } else if ($request->has('lang')) {
                return $request->query('lang');
            } else if ($request->session()->has('lang')) {
                return $request->session()->get('lang');
            }
        } else {
            // Web
            if (in_array($request->segment(1), GoDesk::websiteLangs()) && $request->segment(1) !== GoDesk::websiteLang()) {
                return $request->segment(1);
            }
        }
        return GoDesk::websiteLang();
    }

    /**
     * @param $request
     * @return bool
     */
    private function isProfile($request): bool
    {
        return $request->segment(1) === get_setting('prefix_profile');
    }
}