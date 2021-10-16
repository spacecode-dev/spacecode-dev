<?php

namespace App\Console\Commands;

use App\Notifications\OrderReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use SpaceCode\GoDesk\GoDesk;
use SpaceCode\GoDesk\Models\ContactForm;

class OrdersReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $form = ContactForm::whereIn('status', ['new', 'pending'])->get();
        $form->map(function ($item) {
            $isStep = array_key_exists('step', $item->detail);
            if($item->detail['type'] === 'orderForm' && $isStep) {
                $f = 'Y-m-d H:i';
                $now = Carbon::createFromFormat($f, Carbon::now(GoDesk::timezone())->rawFormat($f));
                $date = Carbon::createFromFormat($f, $item->created_at->rawFormat($f));

                if(!array_key_exists('reminder_date', $item->detail) && $now->gt($date->addHours(12))) {
                    GoDesk::notifyByMail($item->detail['email'], new OrderReminder($item), $item->detail['lang']);
                    $data = collect($item->data)
                        ->push(['reminder_date', $now->toDateTimeString()])
                        ->push(['reminder_last', '12h'])
                        ->toArray();
                    $item->update(['data' => $data]);
                } else if (array_key_exists('reminder_date', $item->detail)) {
                    if($item->detail['reminder_last'] === '12h' && $now->gt($date->addHours(24))) {
                        GoDesk::notifyByMail($item->detail['email'], new OrderReminder($item), $item->detail['lang']);
                        $data = collect($item->data)
                            ->filter(function($v) {
                                return $v[0] !== 'reminder_date' && $v[0] !== 'reminder_last';
                            })
                            ->push(['reminder_date', $now->toDateTimeString()])
                            ->push(['reminder_last', '24h'])
                            ->toArray();
                        $item->update(['data' => $data]);
                    } else if ($item->detail['reminder_last'] === '24h' && $now->gt($date->addDays(3))) {
                        GoDesk::notifyByMail($item->detail['email'], new OrderReminder($item), $item->detail['lang']);
                        $data = collect($item->data)
                            ->filter(function($v) {
                                return $v[0] !== 'reminder_date' && $v[0] !== 'reminder_last';
                            })
                            ->push(['reminder_date', $now->toDateTimeString()])
                            ->push(['reminder_last', '3d'])
                            ->toArray();
                        $item->update(['data' => $data]);
                    } else if ($item->detail['reminder_last'] === '3d' && $now->gt($date->addDays(7))) {
                        GoDesk::notifyByMail($item->detail['email'], new OrderReminder($item), $item->detail['lang']);
                        $data = collect($item->data)
                            ->filter(function($v) {
                                return $v[0] !== 'reminder_date' && $v[0] !== 'reminder_last';
                            })
                            ->push(['reminder_date', $now->toDateTimeString()])
                            ->push(['reminder_last', '7d'])
                            ->toArray();
                        $item->update(['data' => $data]);
                    } else if ($item->detail['reminder_last'] === '7d' && $now->gt($date->addDays(14))) {
                        GoDesk::notifyByMail($item->detail['email'], new OrderReminder($item), $item->detail['lang']);
                        $data = collect($item->data)
                            ->filter(function($v) {
                                return $v[0] !== 'reminder_date' && $v[0] !== 'reminder_last';
                            })
                            ->push(['reminder_date', $now->toDateTimeString()])
                            ->push(['reminder_last', '14d'])
                            ->toArray();
                        $item->update(['data' => $data]);
                    } else if ($item->detail['reminder_last'] === '14d' && $now->gt($date->addDays(30))) {
                        GoDesk::notifyByMail($item->detail['email'], new OrderReminder($item), $item->detail['lang']);
                        $data = collect($item->data)
                            ->filter(function($v) {
                                return $v[0] !== 'reminder_date' && $v[0] !== 'reminder_last';
                            })
                            ->push(['reminder_date', $now->toDateTimeString()])
                            ->push(['reminder_last', '30d'])
                            ->toArray();
                        $item->update(['data' => $data]);
                    } else if ($item->detail['reminder_last'] === '30d' && $now->gt($date->addDays(45))) {
                        $item->update(['status' => 'canceled']);
                    }
                }
            }
        });
    }
}
