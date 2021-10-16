<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    use ValidatesRequests, SendsPasswordResetEmails;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('nova.guest:'.config('nova.guard'));
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)
                ->markdown('godesk::notifications.godesk-email')
                ->theme('godesk::mail.godesk-html.themes.default')
                ->subject(__('Reset Password Notification'))
                ->line(__('You are receiving this email because we received a password reset request for your account.'))
                ->action(__('Reset Password'), url(config('nova.url').route('nova.password.reset', $token, false)))
                ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
                ->line(__('If you did not request a password reset, no further action is required.'));
        });
    }

    /**
     * @return Application|Factory|Response|View
     */
    public function showLinkRequestForm()
    {
        return view('godesk::auth.passwords.email');
    }

    /**
     * @return PasswordBroker
     */
    public function broker()
    {
        return Password::broker(config('nova.passwords'));
    }
}
