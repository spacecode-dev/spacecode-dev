<?php

namespace SpaceCode\GoDesk\Console\Restore;

use Illuminate\Console\Command;

/**
 * Class RestoreLangsCommand
 * @package SpaceCode\GoDesk\Console
 */
class RestoreLangsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:restore-langs';

    /**
     * @var string
     */
    protected $description = 'Restore GoDesk langs';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-lang',
            '--force' => true,
        ]);

        $this->call('optimize:clear');
    }
}
