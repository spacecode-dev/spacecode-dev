<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ProfileAuthenticate extends Middleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param  string[]  ...$guards
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);
        return $next($request);
    }

    /**
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            $lang = $request->has('lang') ? $request->query('lang') : get_setting('website_lang');
            return route('profile.login', ['lang' => $lang]);
        }
    }
}
