<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class ContactFormPoll extends Notification
{
    use Queueable;

    public $request;

    /**
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $request = $this->request;
        return (new MailMessage)
            ->markdown('godesk::notifications.email')
            ->theme('godesk::mail.html.themes.default')
            ->subject(Lang::get('Request №:number', ['number' => $request->id]))
            ->greeting(Lang::get('Request №:number', ['number' => $request->id]))
            ->line(Lang::get('Your request has been successfully sent and will be forwarded to the account manager very soon.'));
    }

    /**
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
