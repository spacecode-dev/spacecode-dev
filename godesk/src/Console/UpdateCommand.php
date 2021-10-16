<?php

namespace SpaceCode\GoDesk\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class UpdateCommand
 * @package SpaceCode\GoDesk\Console
 */
class UpdateCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:update';

    /**
     * @var string
     */
    protected $description = 'Update CMS GoDesk';

    public function handle()
    {
        $this->comment('Updating GoDesk ...');
        $this->callSilent('godesk:restore-app-views');
        system('composer update');
        $this->info('GoDesk updated successfully.');
    }
}
