<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderResultAdminNotify extends Notification
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
        $url = url('/admin/resources/contact-forms/' . $request->id);
        return (new MailMessage)
            ->markdown('godesk::notifications.email')
            ->theme('godesk::mail.html.themes.default')
            ->subject('Изменения в заказе')
            ->greeting('Заказ №' . $request->id)
            ->line('Клиент предоставил информацию по заказу, перейдите по ссылке ниже')
            ->action('Перейти', $url);
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
