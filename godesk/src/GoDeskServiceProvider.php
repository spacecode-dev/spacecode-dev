<?php

namespace SpaceCode\GoDesk;

use Illuminate\Support\ServiceProvider;

/**
 * Class GoDeskServiceProvider
 * @package SpaceCode\GoDesk
 */
class GoDeskServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../stubs/NovaServiceProvider.stub' => app_path('Providers/NovaServiceProvider.php'),
            __DIR__.'/../stubs/GoDeskServiceProvider.stub' => app_path('Providers/GoDeskServiceProvider.php'),
            __DIR__.'/../stubs/HorizonServiceProvider.stub' => app_path('Providers/HorizonServiceProvider.php'),
            __DIR__.'/../stubs/TelescopeServiceProvider.stub' => app_path('Providers/TelescopeServiceProvider.php'),
        ], 'godesk-provider');

        $this->publishes([
            __DIR__.'/../config/godesk.php' => config_path('godesk.php'),
            __DIR__.'/../stubs/filesystems.stub' => config_path('filesystems.php'),
        ], 'godesk-config');

        $this->publishes([
            __DIR__.'/../resources/styles/sitemap' => public_path('vendor/sitemap'),
            __DIR__.'/../dist/images' => public_path('vendor/godesk/images')
        ], 'godesk-assets');

        $this->publishes([
            __DIR__.'/../database/seeds/GoDeskSettingsSeeder.stub' => database_path('seeds/GoDeskSettingsSeeder.php'),
            __DIR__.'/../database/seeds/GoDeskDatabaseSeeder.stub' => database_path('seeds/GoDeskDatabaseSeeder.php'),
            __DIR__.'/../database/seeds/GoDeskRolesSeeder.stub' => database_path('seeds/GoDeskRolesSeeder.php'),
            __DIR__.'/../database/seeds/GoDeskPermissionsSeeder.stub' => database_path('seeds/GoDeskPermissionsSeeder.php'),
            __DIR__.'/../database/seeds/GoDeskPagesSeeder.stub' => database_path('seeds/GoDeskPagesSeeder.php'),
        ], 'godesk-seeds');

        $this->publishes([
            __DIR__.'/../resources/views/index/inc/css.blade.php' => resource_path('views/vendor/godesk/inc/css.blade.php'),
            __DIR__.'/../resources/views/index/inc/js.blade.php' => resource_path('views/vendor/godesk/inc/js.blade.php'),
            __DIR__.'/../resources/views/index/header.blade.php' => resource_path('views/vendor/godesk/header.blade.php'),
            __DIR__.'/../resources/views/index/footer.blade.php' => resource_path('views/vendor/godesk/footer.blade.php')
        ], 'godesk-views');

        $this->publishes([
            __DIR__.'/../resources/views/index/templates/content.blade.php' => resource_path('views/vendor/godesk/templates/content.blade.php'),
            __DIR__.'/../resources/views/sitemap/' => resource_path('views/vendor/sitemap')
        ], 'godesk-app-views');

        $this->publishes([
            __DIR__.'/../stubs/IndexController.stub' => app_path('Http/Controllers/IndexController.php'),
        ], 'godesk-controller');

        $this->publishes([
            __DIR__.'/../stubs/godeskWeb.stub' => base_path('routes/godeskWeb.php'),
            __DIR__.'/../stubs/godeskApi.stub' => base_path('routes/godeskApi.php'),
        ], 'godesk-routes');

        $this->publishes([
            __DIR__.'/../resources/lang/nova' => resource_path('lang/vendor/nova'),
            __DIR__.'/../resources/lang/en.json' => resource_path('lang/en.json'),
            __DIR__.'/../resources/lang/en' => resource_path('lang/en'),
            __DIR__.'/../resources/lang/ru' => resource_path('lang/ru'),
            __DIR__.'/../resources/lang/uk' => resource_path('lang/uk'),
        ], 'godesk-lang');
    }

    public function register()
    {
        $this->commands([
            Console\ScheduleListCommand::class,
            Console\InstallCommand::class,
            Console\PublishCommand::class,
            Console\UpdateCommand::class,
            Console\PruneStateAttachmentsCommand::class,
            Console\CreateAdminUserCommand::class,
            Console\CreateDeveloperUserCommand::class,
            Console\Restore\RestoreAssetsCommand::class,
            Console\Restore\RestoreConfigCommand::class,
            Console\Restore\RestoreControllersCommand::class,
            Console\Restore\RestoreLangsCommand::class,
            Console\Restore\RestoreRoutesCommand::class,
            Console\Restore\RestoreSeedsCommand::class,
            Console\Restore\RestoreAppViewsCommand::class,
            Console\Restore\RestoreViewsCommand::class,
            Console\Commands\NotificationMakeCommand::class,
        ]);
    }
}
