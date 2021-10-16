<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class OrderResult extends Notification
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
        $social = get_setting('website_social');

        $end = '_en';
        if($request->detail['country_code'] && $request->detail['country_code'] === 'RU') {
            $end = '_ru';
        } else if ($request->detail['country_code'] && $request->detail['country_code'] === 'UA') {
            $end = '';
        }

        $custom = get_setting('custom');
        $priceArray = [];
        if($request->detail['web_type'] === 'landing_page' || $request->detail['web_type'] === 'one_page_website') {
            $priceArray = explode(',', $custom['price_one' . $end]);
        } elseif ($request->detail['web_type'] === 'blog' || $request->detail['web_type'] === 'promo_website' || $request->detail['web_type'] === 'personal_website' || $request->detail['web_type'] === 'website_for_small_business') {
            $priceArray = explode(',', $custom['price_personal' . $end]);
        } elseif ($request->detail['web_type'] === 'corporate_website') {
            $priceArray = explode(',', $custom['price_corporate' . $end]);
        } elseif ($request->detail['web_type'] === 'individual_development' || $request->detail['web_type'] === 'online_portal' || $request->detail['web_type'] === 'ecommerce') {
            $priceArray = explode(',', $custom['price_ecommerce' . $end]);
        }

        $price = $this->toCurrencyValue((int)($priceArray[0] + $priceArray[2]), $request->detail['country_code']);
        if($request->detail['web_design'] === 'yes_unique' || $request->detail['web_design'] === 'yes_template' || $request->detail['web_design'] === 'no_template' || $request->detail['web_design'] === 'underway') {
            $price = $this->toCurrencyValue((int)($priceArray[0] + $priceArray[1] + $priceArray[2]), $request->detail['country_code']);
        }

        $readyPrice = '$' . $price;
        if($request->detail['country_code']) {
            if($request->detail['country_code'] === 'RU') {
                $readyPrice = $price . ' RUB';
            } else if ($request->detail['country_code'] === 'UA') {
                $readyPrice = $price . ' UAH';
            }
        }

        return (new MailMessage)
            ->markdown('godesk::notifications.email')
            ->theme('godesk::mail.html.themes.default')
            ->subject(Lang::get('Request №:number', ['number' => $request->id]))
            ->greeting(Lang::get('Request №:number', ['number' => $request->id]))
            ->line(Lang::get('Hi, :name,', ['name' => $request->detail['name']]))
            ->line(Lang::get('We have received your order and are ready to tell you a preliminary cost.'))
            ->line(new HtmlString(Lang::get('We would like to remind you our benefits before starting: <br>1. You get a free Admin Panel, which will save you both time and money. <br>2. We are Estonian limited liability company (OÜ) with European Bank Account LHV Pank. It means that it is safe and reliable to cooperate with us. <br>3. We`ll take care of getting your business up and running. <br>4. The cost is already included everything. Fully optimized and responsive website with no additional fees. <br>5. We have our own server where you can host your website immediately after it is ready. <br>6. Our system is constantly being updated and improved. You will be able to use all future additional features completely free of charge.')))
            ->line(new HtmlString(Lang::get('The preliminary cost of your project is <b>:cost</b>, according to the selected parameters.', ['cost' => $readyPrice])))
            ->line(new HtmlString(Lang::get('Everything you need to get going is contact with us: <br>WhatsApp - :whatsapp <br>Telegram - :telegram <br>Facebook Messenger - :facebook', ['whatsapp' => $social->chat_whatsapp, 'telegram' => $social->chat_telegram, 'facebook' => $social->chat_messenger])));
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

    /**
     * @param $count
     * @param $country
     * @return int
     */
    public function toCurrencyValue($count, $country): int
    {
        $custom = get_setting('custom');
        $result = (int)($count * $custom->currency_usd_to_euro);
        if($country) {
            if($country === 'UA') {
                $result = (int)($count * $custom->currency_uah_to_euro);
            } else if ($country === 'RU') {
                $result = (int)($count * $custom->currency_rub_to_euro);
            }
        }
        return round($result/10)*10;
    }
}
