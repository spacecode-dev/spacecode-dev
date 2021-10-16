<?php

namespace SpaceCode\GoDesk\Console\Restore;

use Illuminate\Console\Command;

/**
 * Class RestoreAppViewsCommand
 * @package SpaceCode\GoDesk\Console
 */
class RestoreAppViewsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:restore-app-views';

    /**
     * @var string
     */
    protected $description = 'Restore GoDesk app views';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-app-views',
            '--force' => true,
        ]);

        $this->call('optimize:clear');
    }
}
