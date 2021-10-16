<?php

namespace SpaceCode\GoDesk\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\Console\Input\InputOption;

class NotificationMakeCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'godesk:make-notification';

    /**
     * @var string
     */
    protected $description = 'Create a new notification class';

    /**
     * @var string
     */
    protected $type = 'Notification';

    /**
     * @return void
     * @throws FileNotFoundException
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }
    }

    /**
     * @param string $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        return parent::buildClass($name);
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__.'/stubs/notification.stub';
    }

    /**
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Notifications';
    }

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the notification already exists']
        ];
    }
}
