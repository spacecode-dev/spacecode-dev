<?php

namespace SpaceCode\GoDesk\Console;

use Carbon\Carbon;
use Cron\CronExpression;
use Cron\FieldFactory;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;

/**
 * Class ScheduleListCommand
 * @package SpaceCode\GoDesk\Console
 */
class ScheduleListCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'schedule:list {--timezone= : The timezone that times should be displayed in}';

    /**
     * @var string
     */
    protected $description = 'List the scheduled commands';

    /**
     * @param Schedule $schedule
     * @return void
     */
    public function handle(Schedule $schedule)
    {
        foreach ($schedule->events() as $event) {
            $rows[] = [
                $event->command,
                $event->expression,
                $event->description,
                (new CronExpression($event->expression, new FieldFactory))
                    ->getNextRunDate(Carbon::now())
                    ->setTimezone($this->option('timezone', config('app.timezone'))),
            ];
        }

        $this->table([
            'Command',
            'Interval',
            'Description',
            'Next Due',
        ], collect($rows)->unique()->toArray() ?? []);
    }
}
