<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Nova\Nova;
use SpaceCode\GoDesk\Exceptions\Conflict;
use SpaceCode\GoDesk\Models\User;

class AdminController extends Controller
{
    use AuthenticatesUsers, ValidatesRequests;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('nova.guest:'.config('nova.guard'))->except('logout');
    }

    /**
     * @return Application|Factory|Response|View
     */
    public function showLoginForm()
    {
        return view('godesk::auth.login');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect($this->redirectPath());
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response|void
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $tempUser = User::where('email', $request->get('email'))->first();
        if($tempUser && !$tempUser->hasAccessToAdminPanel()) {
            return back()->withErrors(['denied' => __('Access denied. You don\'t have enough permissions.')])->withInput();
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        return Nova::path();
    }

    /**
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(config('nova.guard'));
    }
}
