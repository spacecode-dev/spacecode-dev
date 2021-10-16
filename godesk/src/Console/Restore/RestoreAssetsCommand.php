<?php

namespace SpaceCode\GoDesk\Console\Restore;

use Illuminate\Console\Command;

/**
 * Class RestoreAssetsCommand
 * @package SpaceCode\GoDesk\Console
 */
class RestoreAssetsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:restore-assets';

    /**
     * @var string
     */
    protected $description = 'Restore GoDesk assets';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-assets',
            '--force' => true,
        ]);

        $this->call('optimize:clear');
    }
}
