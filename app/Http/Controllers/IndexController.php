<?php

namespace App\Http\Controllers;

use App\Notifications\ContactFormPoll;
use App\Notifications\OrderAdminNotify;
use App\Notifications\OrderPoll;
use App\Notifications\OrderResult;
use App\Notifications\OrderResultAdminNotify;
use App\Traits\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View as ViewModel;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Http\Controllers\IndexController as GoDeskIndexController;
use SpaceCode\GoDesk\Models\ContactForm;
use SpaceCode\GoDesk\Models\Post;
use SpaceCode\GoDesk\Models\Portfolio;

class IndexController extends GoDeskIndexController
{
    use Order;

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $countryCode = null;
        $custom = get_setting('custom');
        if(ip_info())
            $countryCode = ip_info()['country_code'];

        $settings = collect();

        $hour = (int)explode(',', $custom->price_hour)[2];
        $currency = '$';
        $one = explode(',', $custom->price_one_en);
        $personal = explode(',', $custom->price_personal_en);
        $corporate = explode(',', $custom->price_corporate_en);
        $ecommerce = explode(',', $custom->price_ecommerce_en);

        if($countryCode) {
            if($countryCode === 'UA') {
                $hour = (int)explode(',', $custom->price_hour)[0];
                $one = explode(',', $custom->price_one);
                $personal = explode(',', $custom->price_personal);
                $corporate = explode(',', $custom->price_corporate);
                $ecommerce = explode(',', $custom->price_ecommerce);
                $currency = 'грн';
            } else if ($countryCode === 'RU') {
                $hour = (int)explode(',', $custom->price_hour)[1];
                $one = explode(',', $custom->price_one_ru);
                $personal = explode(',', $custom->price_personal_ru);
                $corporate = explode(',', $custom->price_corporate_ru);
                $ecommerce = explode(',', $custom->price_ecommerce_ru);
                $currency = 'руб';
            }
        }

        $settings->put('prices', (object)[
            'hour' => $this->toCurrencyValue($hour, $countryCode),
            'currency' => $currency,
            'one' => (object)[
                'with' => $this->toCurrencyValue((int)($one[2] + $one[1] + $one[0]), $countryCode),
                'without' => $this->toCurrencyValue((int)($one[2] + $one[0]), $countryCode),
                'design' => $this->toCurrencyValue((int)$one[1], $countryCode)
            ],
            'personal' => (object)[
                'with' => $this->toCurrencyValue((int)($personal[2] + $personal[1] + $personal[0]), $countryCode),
                'without' => $this->toCurrencyValue((int)($personal[2] + $personal[0]), $countryCode),
                'design' => $this->toCurrencyValue((int)$personal[1], $countryCode)
            ],
            'corporate' => (object)[
                'with' => $this->toCurrencyValue((int)($corporate[2] + $corporate[1] + $corporate[0]), $countryCode),
                'without' => $this->toCurrencyValue((int)($corporate[2] + $corporate[0]), $countryCode),
                'design' => $this->toCurrencyValue((int)$corporate[1], $countryCode)
            ],
            'ecommerce' => (object)[
                'with' => $this->toCurrencyValue((int)($ecommerce[2] + $ecommerce[1] + $corporate[0]), $countryCode),
                'without' => $this->toCurrencyValue((int)($ecommerce[2] + $ecommerce[0]), $countryCode),
                'design' => $this->toCurrencyValue((int)$ecommerce[1], $countryCode)
            ]
        ]);

        parent::__construct($settings ?? false);
    }

    /**
     * @param $slug
     * @return Factory|ViewModel
     */
    public function index($slug = null): object
    {
        $entity = parent::index($slug);
        if($entity->type === 'home') {
            $entity->items = Portfolio::where(['status' => 'published'])->get();
            $entity->items->map(function ($item) {
                return $item->translateMutator();
            });
        } else if ($entity->slug === 'posts') {
            $entity->paginatedItems = Post::where(['status' => 'published'])->paginate(13);
            $entity->paginatedItems->getCollection()->map(function ($item) {
                return $item->translateMutator();
            });
        } else if ($entity->slug === 'portfolio') {
            $entity->paginatedItems = Portfolio::where(['status' => 'published'])->paginate(12);
            $entity->paginatedItems->getCollection()->map(function ($item) {
                return $item->translateMutator();
            });
        } else if($entity->slug === 'order') {
            if(request()->exists('id')) {
                $order = ContactForm::where('id', request()->get('id'))->whereIn('status', ['new', 'pending'])->firstOrFail();
                $entity->orderArray = $order->only(['id', 'detail']);
                $entity->orderData = [
                    'lang' => $entity->locale,
                    'delete' => request()->exists('delete') && request()->get('delete') === 'true',
                    'websiteArray' => $this->websites(),
                    'webdesignArray' => $this->webdesign()
                ];
            } else {
                abort(404);
            }
        } else if($entity->slug === 'contacts') {
            $entity->contactData = [
                'lang' => $entity->locale,
                'type' => 'contactForm'
            ];
        }
        if($entity->slug === 'laravel-application-development' || $entity->slug === 'website-development' || $entity->type === 'home') {
            $entity->orderData = [
                'lang' => $entity->locale,
                'pageType' => $entity->type,
                'country' => ip_info() ? ip_info()['country_code'] : null,
                'type' => 'orderForm'
            ];
        }
        if (parent::getRequestPrefix(request()) === 'portfolio') {
            $nextFirst = Portfolio::where(['guard_name' => 'web', 'status' => 'published'])->where('id', '>', $entity->id)->orderBy('id', 'asc')->first();
            $prevFirst = Portfolio::where(['guard_name' => 'web', 'status' => 'published'])->where('id', '<', $entity->id)->orderBy('id', 'desc')->first();
            $next = $nextFirst;
            $prev = $prevFirst;
            if(!$nextFirst) {
                $next = Portfolio::where(['guard_name' => 'web', 'status' => 'published'])->first();
            }
            if(!$prevFirst) {
                $prev = Portfolio::where(['guard_name' => 'web', 'status' => 'published'])->orderBy('id', 'desc')->first();
            }
            $entity->relativePortfolio = [
                'next' => $next ? $next->translateMutator() : null,
                'prev' => $prev ? $prev->translateMutator() : null
            ];
        }
        return view($entity->indexView, ['entity' => $entity]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function formIndex(Request $request): JsonResponse
    {
        $ip_info = null;
        if(ip_info())
            $ip_info = ip_info();
        $lang = $request->get('lang');
        $type = $request->get('type');
        app()->setLocale($lang);

        $request->validate([
            'type' => ['required'],
            'data' => ['required'],
            'lang' => ['required'],
            'source' => ['required']
        ]);

        if($type === 'contactForm') {
            $request->validate([
                'data.name' => ['required'],
                'data.email' => ['required', 'email'],
                'data.about' => ['required']
            ], [
                'data.name.required' => __('Name field is required.'),
                'data.email.required' => __('Email field is required.'),
                'data.email.email' => __('Email field must be a valid email address.'),
                'data.about.required' => __('About field is required.'),
            ]);
            $form = new ContactForm;
            $form->source = $request->get('source');
            $form->data = collect($request->get('data'))->map(function ($val, $key) {
                return [$key, $val];
            })->prepend(['type', $type])->values();
            if($ip_info) {
                $form->data = collect($form->data)
                    ->push(['country_code', $ip_info['country_code']])
                    ->push(['country', $ip_info['country']])
                    ->push(['city', $ip_info['city']])
                    ->toArray();
            }
            $form->save();
            GoDesk::notifyByMail($form['detail']['email'], new ContactFormPoll($form), $lang);
            GoDesk::notifyByMail(get_setting('custom')->admin_email, new OrderAdminNotify($form), 'ru');
            return response()->json(['success' => __('Your request has been sent successfully.')]);
        } else if ($type === 'orderForm') {

            $phoneValidation = ['sometimes'];
            if($ip_info) {
                if($ip_info['country_code'] === 'UA') {
                    $phoneValidation = ['required', 'starts_with:+380', 'min:13'];
                } else if ($ip_info['country_code'] === 'RU') {
                    $phoneValidation = ['required', 'starts_with:+7', 'min:12'];
                }
            }

            $request->validate([
                'data.name' => ['required'],
                'data.email' => ['required', 'email'],
                'data.phone' => $phoneValidation
            ], [
                'data.name.required' => __('Name field is required.'),
                'data.email.required' => __('Email field is required.'),
                'data.email.email' => __('Email field must be a valid email address.'),
                'data.phone.required' => __('Phone field is required.'),
                'data.phone.starts_with' => __('Phone field must start with one of the following: :values.'),
                'data.phone.min' => __('Phone field must be at least :min characters.'),
            ]);
            $form = new ContactForm;
            $form->source = $request->get('source');
            $form->data = collect($request->get('data'))->map(function ($val, $key) {
                return [$key, $val];
            })->prepend(['type', $type])->prepend(['lang', $lang])->values();
            if($ip_info) {
                $form->data = collect($form->data)
                    ->push(['country_code', $ip_info['country_code']])
                    ->push(['country', $ip_info['country']])
                    ->push(['city', $ip_info['city']])
                    ->toArray();
            }
            $form->save();
            GoDesk::notifyByMail($form['detail']['email'], new OrderPoll($form), $lang);
            GoDesk::notifyByMail(get_setting('custom')->admin_email, new OrderAdminNotify($form), 'ru');

            $url = url('order?id=' . $form->id);
            if($lang === 'ru' || $lang === 'uk') {
                $url = url($lang . '/order?id=' . $form->id);
            }

            return response()->json(['success' => __('Your request has been sent successfully. A message has been sent to your email.'), 'orderUrl' => $url]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function orderDelete(Request $request): JsonResponse
    {
        app()->setLocale($request->get('lang'));
        $order = ContactForm::find($request->get('id'));
        if($order) {
            $order->update(['status' => 'canceled']);
            return response()->json(['success' => __('Your order has been deleted.')]);
        } else {
            return response()->json(['success' => __('Your order has already been deleted.')]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function orderUpdate(Request $request): JsonResponse
    {
        app()->setLocale($request->get('lang'));
        $step = $request->get('data')['step'];
        $order = ContactForm::find($request->get('id'));
        if($step === 1) {
            $request->validate([
                'data.web_type' => ['required'],
                'data.web_design' => ['required'],
                'data.languages' => ['required'],
            ], [
                'data.web_type.required' => __('Website type is required.'),
                'data.web_design.required' => __('You need to answer the question - "Do you have a web design?".'),
                'data.languages.required' => __('You need to answer the question - "How many languages does the website have?".')
            ]);
            $data = collect([
                ['lang', array_key_exists('lang', $order->detail) ? $order->detail['lang'] : 'en'],
                ['type', 'orderForm'],
                ['step', 2],
                ['name', $order->detail['name']],
                ['email', $order->detail['email']],
                ['phone', $order->detail['phone']],
                array_key_exists('country_code', $order->detail) ? ['country_code', $order->detail['country_code']] : null,
                array_key_exists('country', $order->detail) ? ['country', $order->detail['country']] : null,
                array_key_exists('city', $order->detail) ? ['city', $order->detail['city']] : null,
                ['web_type', $request->get('data')['web_type']],
                ['web_design', $request->get('data')['web_design']],
                $request->get('data')['web_design_detail'] ? ['web_design_detail', $request->get('data')['web_design_detail']] : null,
                $request->get('data')['languages'] > 1 ? ['languages', $request->get('data')['languages']] : null,
                count($request->get('data')['examples']) ? ['examples', implode(', ', $request->get('data')['examples'])] : null
            ])->filter()->values();
            $order->update(['data' => $data->toArray(), 'status' => 'pending']);
            return response()->json(['order' => $order->only(['id', 'detail'])]);
        } else if ($step === 2) {
            $data = collect([
                ['lang', array_key_exists('lang', $order->detail) ? $order->detail['lang'] : 'en'],
                ['type', 'orderForm'],
                ['step', 3],
                ['name', $order->detail['name']],
                ['email', $order->detail['email']],
                ['phone', $order->detail['phone']],
                array_key_exists('country_code', $order->detail) ? ['country_code', $order->detail['country_code']] : null,
                array_key_exists('country', $order->detail) ? ['country', $order->detail['country']] : null,
                array_key_exists('city', $order->detail) ? ['city', $order->detail['city']] : null,
                ['web_type', $order->detail['web_type']],
                ['web_design', $order->detail['web_design']],
                array_key_exists('web_design_detail', $order->detail) ? ['web_design_detail', $order->detail['web_design_detail']] : null,
                array_key_exists('languages', $order->detail) ? ['languages', $order->detail['languages']] : null,
                array_key_exists('examples', $order->detail) ? ['examples', $order->detail['examples']] : null,
                $request->get('data')['scope'] ? ['scope', $request->get('data')['scope']] : null,
                $request->get('data')['purpose'] ? ['purpose', $request->get('data')['purpose']] : null,
                $request->get('data')['audience'] ? ['audience', $request->get('data')['audience']] : null
            ])->filter()->values();
            $order->update(['data' => $data->toArray(), 'status' => 'pending']);
            return response()->json(['order' => $order->only(['id', 'detail'])]);
        } else if ($step === 3) {
            $request->validate([
                'data.contacts' => ['required']
            ], [
                'data.contacts.required' => __('Contacts field is required.')
            ]);
            $data = collect([
                ['lang', array_key_exists('lang', $order->detail) ? $order->detail['lang'] : 'en'],
                ['type', 'orderForm'],
                ['step', 4],
                ['name', $order->detail['name']],
                ['email', $order->detail['email']],
                ['phone', $order->detail['phone']],
                array_key_exists('country_code', $order->detail) ? ['country_code', $order->detail['country_code']] : null,
                array_key_exists('country', $order->detail) ? ['country', $order->detail['country']] : null,
                array_key_exists('city', $order->detail) ? ['city', $order->detail['city']] : null,
                ['web_type', $order->detail['web_type']],
                ['web_design', $order->detail['web_design']],
                array_key_exists('web_design_detail', $order->detail) ? ['web_design_detail', $order->detail['web_design_detail']] : null,
                array_key_exists('languages', $order->detail) ? ['languages', $order->detail['languages']] : null,
                array_key_exists('examples', $order->detail) ? ['examples', $order->detail['examples']] : null,
                array_key_exists('scope', $order->detail) ? ['scope', $order->detail['scope']] : null,
                array_key_exists('purpose', $order->detail) ? ['purpose', $order->detail['purpose']] : null,
                array_key_exists('audience', $order->detail) ? ['audience', $order->detail['audience']] : null,
                ['contacts', $request->get('data')['contacts']]
            ])->filter()->values();
            $order->update(['data' => $data->toArray(), 'status' => 'processed']);
            GoDesk::notifyByMail($order->detail['email'], new OrderResult($order), $order->detail['lang']);
            GoDesk::notifyByMail(get_setting('custom')->admin_email, new OrderResultAdminNotify($order), 'ru');
            return response()->json(['success' => __('You have completed all steps. A message has been sent to your email.')]);
        }
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