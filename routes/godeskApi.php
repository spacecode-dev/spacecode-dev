<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| GoDesk API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your goDesk application. These
| routes are loaded by the GoDeskServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('requests/put', 'IndexController@formIndex');
Route::post('requests/delete', 'IndexController@orderDelete');
Route::post('requests/update', 'IndexController@orderUpdate');
