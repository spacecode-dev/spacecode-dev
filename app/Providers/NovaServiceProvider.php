<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use SpaceCode\GoDesk\Models\Settings;
use SpaceCode\GoDesk\Tools\FilemanagerTool;
use SpaceCode\GoDesk\Tools\NovaTool;
use SpaceCode\GoDesk\Tools\SettingsTool;
use SpaceCode\GoDesk\Traits\Resolve;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    use Resolve;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        SettingsTool::setSettingsFields();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return $this->checkAssignment($user, 'viewNova');
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            NovaTool::make(),
            SettingsTool::make()
                ->canSee(function () {
                    return Gate::allows('viewAny', Settings::class);
                }),
            FilemanagerTool::make()
                ->canSee(function ($request) {
                    return $this->checkAssignment($request->user(), 'Filemanager viewAny');
                }),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
