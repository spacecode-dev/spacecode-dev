<?php

namespace SpaceCode\GoDesk\Console\Restore;

use Illuminate\Console\Command;

/**
 * Class RestoreConfigCommand
 * @package SpaceCode\GoDesk\Console
 */
class RestoreConfigCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:restore-config';

    /**
     * @var string
     */
    protected $description = 'Restore GoDesk config files';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-config',
            '--force' => true,
        ]);

        $this->call('optimize:clear');
    }
}
