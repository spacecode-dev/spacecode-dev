<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectProfileIfAuthenticated;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use SpaceCode\GoDesk\GoDesk;
use stdClass;

class ResetPasswordController extends Controller
{
    use ValidatesRequests, ResetsPasswords;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware(RedirectProfileIfAuthenticated::class);
        $index = new \SpaceCode\GoDesk\Http\Controllers\IndexController;
        $settings = collect([]);
        $index->__construct($settings);
    }

    /**
     * @param Request $request
     * @param  string|null  $token
     * @return Factory|View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $entity = new stdClass();
        $entity->locale = session()->has('lang') ? session()->get('lang') : get_setting('website_lang');
        return view('profile.auth.passwords.reset', ['entity' => $entity, 'token' => $token, 'email' => $request->get('email')]);
    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        return GoDesk::profilePath();
    }

    /**
     * @return PasswordBroker
     */
    public function broker()
    {
        return Password::broker(config('nova.passwords'));
    }

    /**
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(config('nova.guard'));
    }
}
