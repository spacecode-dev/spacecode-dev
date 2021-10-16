<?php

namespace SpaceCode\GoDesk;

use Illuminate\Support\Facades\Route;
use SpaceCode\GoDesk\Http\Middleware\Authorize;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Routing\Middleware\SubstituteBindings;
use SpaceCode\GoDesk\Http\Middleware\Locale;

/**
 * Class PendingRouteRegistration
 * @package SpaceCode\GoDesk
 */
class PendingRouteRegistration
{
    /**
     * @return $this
     */
    public function withToolsRoutes(): PendingRouteRegistration
    {
        Route::namespace('SpaceCode\GoDesk\Http\Controllers')->group(function () {
            Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/filemanager')
                ->group(function () {
                    Route::get('data', 'FilemanagerToolController@getData');
                    Route::get('{resource}/{attribute}/data', 'FilemanagerToolController@getDataField');
                    Route::post('actions/move', 'FilemanagerToolController@move');
                    Route::post('actions/create-folder', 'FilemanagerToolController@createFolder');
                    Route::post('actions/delete-folder', 'FilemanagerToolController@deleteFolder');
                    Route::post('actions/get-info', 'FilemanagerToolController@getInfo');
                    Route::post('actions/remove-file', 'FilemanagerToolController@removeFile');
                    Route::post('actions/rename-file', 'FilemanagerToolController@renameFile');
                    Route::get('actions/download-file', 'FilemanagerToolController@downloadFile');
                    Route::post('actions/rename', 'FilemanagerToolController@rename');
                    Route::post('events/folder', 'FilemanagerToolController@folderUploadedEvent');
                    Route::post('uploads/add', 'FilemanagerToolController@upload');
                    Route::get('uploads/update', 'FilemanagerToolController@updateFile');
                });
            Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/media-library')
                ->group(function () {
                    Route::get('download/{media}', 'DownloadMediaController@show');
                    Route::get('media', 'MediaController@index');
                });
            Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/settings')
                ->group(function () {
                    Route::get('', 'SettingsController@get')->name('settingsGet');
                    Route::post('', 'SettingsController@save')->name('settingsSave');
                });
            Route::delete('/nova-api/settings/settings/field/{fieldName}', 'SettingsController@deleteImage');
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function withUserRoutes(): PendingRouteRegistration
    {
        Route::namespace('App\Http\Controllers')
            ->middleware(['web', Locale::class])
            ->group(base_path('routes/godeskWeb.php'));

        return $this;
    }

    /**
     * @return $this
     */
    public function withApiRoutes(): PendingRouteRegistration
    {
        Route::namespace('App\Http\Controllers')
            ->middleware('auth:sanctum')
            ->prefix('api')
            ->group(base_path('routes/godeskApi.php'));

        return $this;
    }

    /**
     * @return $this
     */
    public function withIndexRoutes(): PendingRouteRegistration
    {
        $request = request();
        if (
            !$request->is(GoDesk::adminPrefix()) && !$request->is(GoDesk::adminPrefix() . '/*') &&
            !$request->is('nova-api') && !$request->is('nova-api/*') &&
            !$request->is('nova-vendor') && !$request->is('nova-vendor/*') &&
            !$request->is('godesk-api') && !$request->is('godesk-api/*') &&
            !$request->is('godesk-vendor') && !$request->is('godesk-vendor/*') &&
            !$request->is('api') && !$request->is('api/*') &&
            !$request->is('telescope') && !$request->is('telescope/*') &&
            !$request->is('horizon') && !$request->is('horizon/*')
        ) {
            Route::namespace('SpaceCode\GoDesk\Http\Controllers')
                ->middleware('web')
                ->as('godesk.')->group(function () {
                    // Robots.txt
                    Route::get('robots.txt', 'RobotsController@get')->name('robots-txt');

                    // Sitemap.xml
                    Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap-xml');
                    Route::get('sitemap-homepage.xml', 'SitemapController@home')->name('sitemap-homepage-xml');
                    Route::get('sitemap-pages.xml', 'SitemapController@pages')->name('sitemap-pages-xml');
                    if(get_setting('use_blog')) {
                        Route::get('sitemap-posts.xml', 'SitemapController@posts')->name('sitemap-posts-xml');
                        Route::get('sitemap-post-categories.xml', 'SitemapController@postCategories')->name('sitemap-post-categories-xml');
                        Route::get('sitemap-post-tags.xml', 'SitemapController@postTags')->name('sitemap-post-tags-xml');
                    }
                    if(get_setting('use_portfolio')) {
                        Route::get('sitemap-portfolio.xml', 'SitemapController@portfolio')->name('sitemap-portfolio-xml');
                    }
                });
            Route::namespace('App\Http\Controllers')
                ->middleware(['web', Locale::class])
                ->as('godesk.')->group(function () {
                    // Pages
                    Route::get('{slug?}', 'IndexController@index')->where('slug','.+')->name('page');
                });
        }
        return $this;
    }
}
