<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix'     => 'v1',
    'as'         => 'api.',
    'namespace'  => 'Api\\v1',
], function () {

    // Items
    Route::group([
        'prefix' => 'items'
    ], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'ItemsController@index',
        ]);
    });

});