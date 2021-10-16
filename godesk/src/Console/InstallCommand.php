<?php

namespace SpaceCode\GoDesk\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SpaceCode\GoDesk\Models\User;

/**
 * Class InstallCommand
 * @package SpaceCode\GoDesk\Console
 */
class InstallCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:install';

    /**
     * @var string
     */
    protected $description = 'Install all of the GoDesk resources';

    public function handle()
    {
        $this->comment('Installing Nova ...');
        $this->callSilent('nova:install');
        $this->removeNovaUser();

        $this->comment('Installing Telescope ...');
        $this->callSilent('telescope:install');

        $this->comment('Installing Horizon ...');
        $this->callSilent('horizon:install');

        $this->comment('Publishing GoDesk Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'godesk-provider']);
        $this->callSilent('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider']);
        $this->callSilent('vendor:publish', ['--provider' => 'Laravel\Sanctum\SanctumServiceProvider']);

        $this->comment('Publishing GoDesk Tools...');
        $this->callSilent('vendor:publish', ['--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider', '--tag' => 'config']);
        $this->callSilent('vendor:publish', ['--tag' => 'nova-media-library']);

        $this->comment('Publishing GoDesk Assets / Resources...');
        $this->callSilent('godesk:publish');

        $this->registerServiceProvider();
        $this->registerMiddleware();
        $this->changeAdminPath();
        $this->changeAuthModel();
        $this->removeRobots();
        $this->removeFavicon();
        $this->clearWebRoute();

        $this->setAppNamespace();

        if ($this->confirm('Do you need to create a symbolic link?')) {
            $this->comment('Symbolic link creating...');
            $this->storageBuild();
        }

        if ($this->confirm('Do you want to create Admin user?')) {
            $this->registerAdmin();
        }

        $this->info('GoDesk scaffolding installed successfully.');
    }

    protected function registerServiceProvider()
    {
        if(!in_array('App\Providers\GoDeskServiceProvider', config('app.providers'))) {
            $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());
            file_put_contents(config_path('app.php'), str_replace(
                "{$namespace}\\Providers\EventServiceProvider::class,".PHP_EOL,
                "{$namespace}\\Providers\EventServiceProvider::class,".PHP_EOL."        {$namespace}\Providers\GoDeskServiceProvider::class,".PHP_EOL,
                file_get_contents(config_path('app.php'))
            ));
        }
        if(!in_array('Spatie\Permission\PermissionServiceProvider', config('app.providers'))) {
            $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());
            file_put_contents(config_path('app.php'), str_replace(
                "{$namespace}\\Providers\GoDeskServiceProvider::class,".PHP_EOL,
                "{$namespace}\\Providers\GoDeskServiceProvider::class,".PHP_EOL."        Spatie\Permission\PermissionServiceProvider::class,".PHP_EOL,
                file_get_contents(config_path('app.php'))
            ));
        }
    }

    protected function registerMiddleware()
    {
        if(!in_array('SpaceCode\GoDesk\ForgetCachedPermissions', config('nova.middleware'))) {
            file_put_contents(config_path('nova.php'), str_replace(
                "Authorize::class,".PHP_EOL,
                "Authorize::class,".PHP_EOL."        SpaceCode\GoDesk\ForgetCachedPermissions::class,".PHP_EOL,
                file_get_contents(config_path('nova.php'))
            ));
        }
    }

    protected function changeAdminPath()
    {
        if(config('nova.path') === '/nova') {
            file_put_contents(config_path('nova.php'), str_replace(
                '/nova',
                config('godesk.admin_path'),
                file_get_contents(config_path('nova.php'))
            ));
        }
    }

    protected function changeAuthModel()
    {
        if(config('auth.providers.users.model') === 'App\User') {
            file_put_contents(config_path('auth.php'), str_replace(
                'App\User',
                'SpaceCode\GoDesk\Models\User',
                file_get_contents(config_path('auth.php'))
            ));
        }
    }

    protected function removeRobots()
    {
        $robot = public_path('robots.txt');
        if(File::exists($robot)) {
            File::delete($robot);
        }
    }

    protected function removeFavicon()
    {
        $favicon = public_path('favicon.ico');
        if(File::exists($favicon)) {
            File::delete($favicon);
        }
    }

    protected function clearWebRoute()
    {
        $route = File::get(base_path('routes/web.php'));
        if(Str::contains($route, 'return view(\'welcome\')')) {
            file_put_contents(base_path('routes/web.php'), str_replace(
                'Route::get(\'/\', function () {
    return view(\'welcome\');
});',
                '',
                file_get_contents(base_path('routes/web.php'))
            ));
        }
    }

    protected function setAppNamespace()
    {
        $namespace = $this->laravel->getNamespace();
        $this->setAppNamespaceOn(app_path('Providers/GoDeskServiceProvider.php'), $namespace);
    }

    protected function removeNovaUser()
    {
        $user = app_path('Nova/User.php');
        if(File::exists($user)) {
            File::delete($user);
        }
    }

    /**
     * @param string $file
     * @param string $namespace
     */
    protected function setAppNamespaceOn(string $file, string $namespace)
    {
        file_put_contents($file, str_replace(
            'App\\',
            $namespace,
            file_get_contents($file)
        ));
    }

    protected function storageBuild(): bool
    {
        if (!\File::exists(public_path('storage')))
            $this->call('storage:link');
        return true;
    }

    protected function registerAdmin()
    {
        $this->comment('Admin user creating...');
        $adminEmail = $this->ask('What is your email?');
        $adminFirstName = $this->ask('What is your first name?');
        $adminLastName = $this->ask('What is your last name?');
        $adminPassword = $this->secret('What is the password?');
        $adminLang = $this->anticipate('What is your native language?', ['English', 'Russian', 'Ukrainian']);

        if($adminEmail && $adminPassword) {
            $name = '';
            if(!empty($adminFirstName))
                $name .= $adminFirstName;
            if(!empty($adminLastName))
                $name .= ' ' . $adminLastName;

            $lang = 'en';
            if($adminLang === 'Russian') {
                $lang = 'ru';
            } else if ($adminLang === 'Ukrainian') {
                $lang = 'uk';
            }
            $user = User::firstOrCreate(
                ['email' => $adminEmail],
                ['name' => $name, 'lang' => $lang, 'email' => $adminEmail, 'password' => bcrypt($adminPassword)]
            );
            $user->assignRole('admin');
        }
    }
}
