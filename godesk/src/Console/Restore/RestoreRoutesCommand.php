<?php

namespace SpaceCode\GoDesk\Console\Restore;

use Illuminate\Console\Command;

/**
 * Class RestoreRoutesCommand
 * @package SpaceCode\GoDesk\Console
 */
class RestoreRoutesCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:restore-routes';

    /**
     * @var string
     */
    protected $description = 'Restore GoDesk routes';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-routes',
            '--force' => true,
        ]);

        system('composer dump-autoload');

        $this->call('optimize:clear');
    }
}
