<?php

namespace SpaceCode\GoDesk\Console\Restore;

use Illuminate\Console\Command;

/**
 * Class RestoreViewsCommand
 * @package SpaceCode\GoDesk\Console
 */
class RestoreViewsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:restore-views';

    /**
     * @var string
     */
    protected $description = 'Restore GoDesk views';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-views',
            '--force' => true,
        ]);

        $this->call('optimize:clear');
    }
}
