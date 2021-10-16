<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| GoDesk Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your goDesk application. These
| routes are loaded by the GoDeskServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix(get_setting('prefix_profile'))
    ->group(function () {
        Route::get('/login', 'AuthController@showLoginForm')->name('profile.login');
        Route::get('/register', 'AuthController@showRegisterForm')->name('profile.register');
        Route::post('/login', 'AuthController@login')->name('postProfile.login');
        Route::post('/register', 'AuthController@register')->name('postProfile.register');

        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('profile.password.request');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('profile.password.email');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('profile.password.reset');
        Route::post('/password/reset', 'ResetPasswordController@reset');

        Route::get('', 'ProfileController@showProfile')->name('profile');
        Route::get('/password', 'ProfileController@showPassword')->name('profile.password');
        Route::get('/release/{version}', 'ProfileController@getRelease')->name('profile.release');
        Route::get('/licenses', 'ProfileController@showLicenses')->name('profile.licenses');
        Route::get('/settings', 'ProfileController@showSettings')->name('profile.settings');
        Route::post('/update', 'ProfileController@update')->name('profile.update');
        Route::post('/new-license', 'ProfileController@newLicense')->name('profile.new-license');
        Route::post('/rename-license', 'ProfileController@renameLicense')->name('profile.rename-license');
        Route::get('/logout', 'AuthController@logout')->name('profile.logout');
    });


