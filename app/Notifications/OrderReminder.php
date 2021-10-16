<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class OrderReminder extends Notification
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
        $lang = $request->detail['lang'];
        $url = url('order?id=' . $request->id);
        $deleteUrl = url('order?id=' . $request->id . '&delete=true');
        if($lang === 'ru' || $lang === 'uk') {
            $url = url($lang . '/order?id=' . $request->id);
            $deleteUrl = url('order?id=' . $request->id . '&delete=true');
        }
        return (new MailMessage)
            ->markdown('godesk::notifications.email')
            ->theme('godesk::mail.html.themes.default')
            ->subject(Lang::get('Request №:number', ['number' => $request->id]))
            ->greeting(Lang::get('Request №:number', ['number' => $request->id]))
            ->line(Lang::get('Hi, :name,', ['name' => $request->detail['name']]))
            ->line(Lang::get('Just a friendly reminder that you still need to complete the application form.'))
            ->action(Lang::get('Complete Now'), $url)
            ->line(Lang::get('If you change your mind and no longer need reminders, follow the link :link', ['link' => $deleteUrl]));
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
