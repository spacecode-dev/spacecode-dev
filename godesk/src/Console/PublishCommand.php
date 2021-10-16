<?php

namespace SpaceCode\GoDesk\Console;

use Illuminate\Console\Command;

/**
 * Class PublishCommand
 * @package SpaceCode\GoDesk\Console
 */
class PublishCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:publish {--force : Overwrite any existing files}';

    /**
     * @var string
     */
    protected $description = 'Publish all of the GoDesk resources';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'godesk-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'godesk-seeds',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'godesk-views',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'godesk-app-views',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'godesk-assets',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'godesk-routes',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'godesk-controller',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'godesk-lang',
            '--force' => $this->option('force'),
        ]);

        system('composer dump-autoload');

        $this->call('migrate');
        $this->call('db:seed', ['--class' => 'GoDeskDatabaseSeeder']);

        $this->call('optimize:clear');
    }
}
