<?php

namespace SpaceCode\GoDesk;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\Trix\PruneStaleAttachments;
use Laravel\Telescope\TelescopeServiceProvider;
use SpaceCode\GoDesk\Models;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class GoDeskApplicationServiceProvider
 * @package SpaceCode\GoDesk
 */
class GoDeskApplicationServiceProvider extends ServiceProvider
{
    /**
     * @param Models\User $user
     */
    public function boot(Models\User $user)
    {
        if ($this->app->runningInConsole()) {
            $this->app->register(GoDeskServiceProvider::class);
        }

        $this->app->register(TelescopeServiceProvider::class);

        $this->sitemap();

        $this->aliases();
        $this->loadHelper();
        $this->loadRoutes();
        $this->loadSchedule();
        $this->registerPolicies($user);

        if (!$this->app->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__ . '/../config/godesk.php', 'godesk');
        }

        Nova::serving(function (ServingNova $event) {
            app()->setLocale(Auth::user()['lang']);
            Nova::style('theme', __DIR__ . '/../dist/css/theme.css');
            Nova::script('theme', __DIR__ . '/../resources/js/theme.js');
            Nova::script('tabs-field', __DIR__ . '/../dist/js/tabs-field.js');
            Nova::script('toggle', __DIR__.'/../dist/js/toggle-field.js');
            Nova::style('toggle', __DIR__.'/../dist/css/toggle-field.css');
            Nova::script('filemanager-field', __DIR__ . '/../dist/js/filemanager-field.js');
            Nova::script('media-library-field', __DIR__ . '/../dist/js/media-library-field.js');
            Nova::script('table-field', __DIR__ . '/../dist/js/table-field.js');
            Nova::script('color-field', __DIR__ . '/../dist/js/color-field.js');
            Nova::style('table-field', __DIR__ . '/../dist/css/table-field.css');
            Nova::provideToScript([
                'ntr' => config('godesk.responsive')
            ]);
        });

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang/godesk');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'godesk');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/vendor/godesk', 'godesk-index');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/vendor/sitemap', 'godesk-sitemap');
    }

    protected function loadHelper()
    {
        require_once __DIR__ . '/../helpers/helpers.php';
        if (File::exists(app_path('/Http/helpers.php'))) {
            require_once app_path('/Http/helpers.php');
        }
    }

    protected function registerPolicies($user)
    {
        Gate::policy(Models\User::class, Policy\UserPolicy::class);
        Gate::policy(Models\Settings::class, Policy\SettingPolicy::class);
        Gate::policy(Models\Template::class, Policy\TemplatePolicy::class);
        Gate::policy(Models\Block::class, Policy\TemplatePolicy::class);
        Gate::policy(Models\Application::class, Policy\ApplicationPolicy::class);
        Gate::policy(Models\ContactForm::class, Policy\ContactFormPolicy::class);
        Gate::policy(Role::class, Policy\RolePolicy::class);
        Gate::policy(Permission::class, Policy\PermissionPolicy::class);
        Gate::policy(Models\Page::class, Policy\PagePolicy::class);
        Gate::policy(Models\Post::class, Policy\PostPolicy::class);
        Gate::policy(Models\Portfolio::class, Policy\PortfolioPolicy::class);
        Gate::policy(Models\PostTag::class, Policy\PostTagPolicy::class);
        Gate::policy(Models\PostCategory::class, Policy\PostCategoryPolicy::class);
    }

    protected function aliases()
    {
        $this->app->alias(
            \SpaceCode\GoDesk\Http\Controllers\RouterController::class,
            \Laravel\Nova\Http\Controllers\RouterController::class
        );
        $this->app->alias(
            \SpaceCode\GoDesk\Http\Controllers\AdminController::class,
            \Laravel\Nova\Http\Controllers\LoginController::class
        );
        $this->app->alias(
            \SpaceCode\GoDesk\Http\Controllers\ForgotPasswordController::class,
            \Laravel\Nova\Http\Controllers\ForgotPasswordController::class
        );
        $this->app->alias(
            \SpaceCode\GoDesk\Http\Controllers\ResetPasswordController::class,
            \Laravel\Nova\Http\Controllers\ResetPasswordController::class
        );
    }

    protected function loadRoutes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }
        GoDesk::routes()
            ->withToolsRoutes()
            ->withUserRoutes()
            ->withApiRoutes()
            ->withIndexRoutes();
    }

    protected function loadSchedule()
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('telescope:prune --hours=48')->daily()->timezone(GoDesk::timezone());
            $schedule->command('godesk:prune-attachments')->daily()->timezone(GoDesk::timezone());
        });
    }

    public function register()
    {
        if (!defined('GODESK_PATH')) {
            define('GODESK_PATH', realpath(__DIR__ . '/../'));
        }
    }

    public function sitemap()
    {
        $this->app->bind('sitemap', function ($app) {
            $config = config('godesk.sitemap');
            return new Sitemap($config, $app['Illuminate\Cache\Repository'], $app['config'], $app['files'], $app['Illuminate\Contracts\Routing\ResponseFactory'], $app['view']);
        });
        $loader = AliasLoader::getInstance();
        $loader->alias('sitemap', Sitemap::class);
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides(): array
    {
        return ['sitemap', Sitemap::class];
    }
}
