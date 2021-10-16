<?php

namespace SpaceCode\GoDesk\Console\Restore;

use Illuminate\Console\Command;

/**
 * Class RestoreSeedsCommand
 * @package SpaceCode\GoDesk\Console
 */
class RestoreSeedsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:restore-seeds';

    /**
     * @var string
     */
    protected $description = 'Restore GoDesk seeds';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-seeds',
            '--force' => true,
        ]);

        $this->call('db:seed', ['--class' => 'GoDeskDatabaseSeeder']);

        $this->call('optimize:clear');
    }
}
