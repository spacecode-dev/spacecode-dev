<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class OrderPoll extends Notification
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
        $lang = app()->getLocale();
        $url = url('order?id=' . $request->id);
        if($lang === 'ru' || $lang === 'uk') {
            $url = url($lang . '/order?id=' . $request->id);
        }
        return (new MailMessage)
            ->markdown('godesk::notifications.email')
            ->theme('godesk::mail.html.themes.default')
            ->subject(Lang::get('Request №:number', ['number' => $request->id]))
            ->greeting(Lang::get('Request №:number', ['number' => $request->id]))
            ->line(Lang::get('Your request has been sent successfully.'))
            ->line(Lang::get('There are still some questions left. Then we will be able to calculate the cost and deadline of the project.'))
            ->line(Lang::get('Please follow the link below to answer questions.'))
            ->action(Lang::get('Step :step', ['step' => 2]), $url);
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
