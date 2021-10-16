<?php

namespace SpaceCode\GoDesk\Console\Restore;

use Illuminate\Console\Command;

/**
 * Class RestoreControllersCommand
 * @package SpaceCode\GoDesk\Console
 */
class RestoreControllersCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:restore-controllers';

    /**
     * @var string
     */
    protected $description = 'Restore GoDesk controllers';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-controller',
            '--force' => true,
        ]);

        $this->call('optimize:clear');
    }
}
