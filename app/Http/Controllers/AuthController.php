<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectProfileIfAuthenticated;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View as ViewModel;
use SpaceCode\GoDesk\Models\User;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use AuthenticatesUsers, ValidatesRequests;

    /**
     * @var \SpaceCode\GoDesk\Http\Controllers\IndexController|string
     */
    private $indexController;

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->middleware(RedirectProfileIfAuthenticated::class)->except('logout');
        $settings = collect([]);
        $this->indexController = new \SpaceCode\GoDesk\Http\Controllers\IndexController;
        $this->indexController->__construct($settings);
    }

    /**
     * @return Application|Factory|ViewModel
     */
    public function showLoginForm()
    {
        $entity = new stdClass();
        $entity->locale = app()->getLocale();
        return view('profile.auth.login', ['entity' => $entity]);
    }

    /**
     * @return Application|Factory|ViewModel
     */
    public function showRegisterForm()
    {
        $entity = new stdClass();
        $entity->locale = app()->getLocale();
        return view('profile.auth.register', ['entity' => $entity]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        $lang = app()->getLocale();
        return $request->wantsJson() ? new JsonResponse([], 204) : redirect($lang);
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Response|void
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            $request->user()->update(['lang' => app()->getLocale()]);
            session()->forget('lang');
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|max:255|unique:users,email|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->lang = app()->getLocale();
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        $user->assignRole('user');

        Auth::login($user);

        $entity = new stdClass();
        $entity->user = $user;
        $entity->locale = $entity->user->lang;
        $entity->index = null;
        $entity->indexType = 'custom';
        $entity->indexClasses = ['profile', 'page'];
        $entity->title = 'Profile';

        return redirect()->route('profile', ['entity' => $entity]);
    }
}