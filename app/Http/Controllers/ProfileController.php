<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ProfileAuthenticate;
use App\License;
use App\Release;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use SpaceCode\GoDesk\Traits\Resolve;

class ProfileController extends Controller
{
    use Resolve, AuthenticatesUsers, ValidatesRequests;

    /**
     * @var \SpaceCode\GoDesk\Http\Controllers\IndexController|string
     */
    private $indexController;

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->middleware(ProfileAuthenticate::class);
        $settings = collect([]);
        $this->indexController = new \SpaceCode\GoDesk\Http\Controllers\IndexController;
        $this->indexController->__construct($settings);
    }

    /**
     * @return Application|Factory|View
     */
    public function showProfile()
    {
        $entity = $this->indexController->customIndex(__('Profile'), ['profile', 'page'], 'profile.index');
        $entity->user = User::find(Auth::id());
        return view($entity->indexView, ['entity' => $entity]);
    }

    /**
     * @return Application|Factory|View
     */
    public function showPassword()
    {
        $entity = $this->indexController->customIndex(__('Password Settings'), ['profile', 'page', 'password'], 'profile.password');
        $entity->user = User::find(Auth::id());
        return view($entity->indexView, ['entity' => $entity]);
    }

    /**
     * @return Application|Factory|View
     */
    public function showSettings()
    {
        $entity = $this->indexController->customIndex(__('User Settings'), ['profile', 'page', 'settings'], 'profile.settings');
        $entity->user = User::find(Auth::id());
        return view($entity->indexView, ['entity' => $entity]);
    }

    /**
     * @return Application|Factory|View
     */
    public function showLicenses()
    {
        $entity = $this->indexController->customIndex(__('Licenses'), ['profile', 'page', 'licenses'], 'profile.licenses');
        $entity->releases = Release::orderBy('created_at', 'desc')->get();
        $entity->user = User::with('licenses')->find(Auth::id());
        return view($entity->indexView, ['entity' => $entity]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $type = $request->get('type');
        $user = $request->user();
        if ($type === 'contacts') {
            $request->validate([
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|string|max:255|email|unique:users,email,' . $user->id
            ], [
                'name.required' => __('validation.required'),
                'name.string' => __('validation.string'),
                'name.min' => __('validation.min'),
                'name.max' => __('validation.max'),
                'email.required' => __('validation.required'),
                'email.string' => __('validation.string'),
                'email.max' => __('validation.max'),
                'email.email' => __('validation.email'),
                'email.unique' => __('validation.unique'),
            ], [
                'name' => __('Name'),
                'email' => __('Email')
            ]);
            $user->update(['name' => $request->get('name'), 'email' => $request->get('email')]);
        } else if ($type === 'password') {
            $request->validate([
                'oldPassword' => ['required', 'string', 'min:8', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'password' => 'required|string|confirmed|min:8'
            ], [
                'oldPassword.required' => __('validation.required'),
                'oldPassword.string' => __('validation.string'),
                'oldPassword.min' => __('validation.min'),
                'password.required' => __('validation.required'),
                'password.string' => __('validation.string'),
                'password.confirmed' => __('validation.confirmed'),
                'password.min' => __('validation.min'),
            ], [
                'oldPassword' => __('Old Password'),
                'password' => __('Password')
            ]);
            $user->update(['password' => bcrypt($request->get('password'))]);
            Auth::logout();
            return redirect()->route('profile.login');
        } else if ($type === 'settings') {
            $val = $request->get('lang');
            $request->validate([
                'lang' => 'required'
            ], [
                'lang.required' => __('validation.required'),
            ], [
                'lang' => __('Language')
            ]);
            $this->putSession('lang', $val);
            app()->setLocale($val);
            $user->update(['lang' => $val]);
        }

        return back()->with('success', __('Profile was updated!'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function newLicense(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|url|unique:licenses,name'
        ], [
            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'name.min' => __('validation.min'),
            'name.max' => __('validation.max'),
            'name.url' => __('validation.url'),
            'name.unique' => __('validation.unique'),
        ], [
            'name' => __('License Name')
        ]);
        $user = $request->user();
        $license = new License;
        $license->author_id = $user->id;
        $license->name = $request->get('name');
        $license->series = get_setting('custom')->last_godesk_series;
        $license->type = 'solo';
        $license->purchased_at = Carbon::now()->format('Y-m-d');
        $license->status = 'active';
        $license->save();
        return back()->with('success', __('New License was created!'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function renameLicense(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|url|unique:licenses,name,' . $request->get('id')
        ], [
            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'name.min' => __('validation.min'),
            'name.max' => __('validation.max'),
            'name.url' => __('validation.url'),
            'name.unique' => __('validation.unique'),
        ], [
            'name' => __('License Name')
        ]);
        License::where('id', $request->get('id'))->update(['name' => $request->get('name')]);
        return back()->with('success', __('The License Name was updated!'));
    }

    /**
     * @param $version
     * @return RedirectResponse
     */
    public function getRelease($version): RedirectResponse
    {
        $release = Release::where('version', $version)->first();
        return redirect()->to($release->download);
    }
}