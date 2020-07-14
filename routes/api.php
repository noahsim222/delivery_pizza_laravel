<?php

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

    // Admin
    Route::group([
        'prefix' => 'admin',
        'namespace'  => 'Admin',
    ], function () {

        // Items
        Route::group([
            'prefix' => 'items'
        ], function () {

            Route::get('/', [
                'as' => 'index',
                'uses' => 'ItemsController@index',
            ]);
            Route::get('/detail/{id}', [
                'as' => 'index',
                'uses' => 'ItemsController@index',
            ]);
            Route::post('/create', [
                'as' => 'create',
                'uses' => 'ItemsController@store',
            ]);
        });

        // Category
        Route::group([
            'prefix' => 'categories'
        ], function () {

            Route::get('/', [
                'as' => 'index',
                'uses' => 'CategoriesController@index',
            ]);
            Route::get('/detail/{id}', [
                'as' => 'index',
                'uses' => 'CategoriesController@index',
            ]);
            Route::post('/create', [
                'as' => 'create',
                'uses' => 'CategoriesController@store',
            ]);
        });

        // Type
        Route::group([
            'prefix' => 'types'
        ], function () {

            Route::get('/', [
                'as' => 'index',
                'uses' => 'TypesController@index',
            ]);
            Route::get('/detail/{id}', [
                'as' => 'index',
                'uses' => 'TypesController@index',
            ]);
            Route::post('/create', [
                'as' => 'create',
                'uses' => 'TypesController@store',
            ]);
        });

        // Currencies
        Route::group([
            'prefix' => 'currencies'
        ], function () {

            Route::get('/', [
                'as' => 'index',
                'uses' => 'CurrenciesController@index',
            ]);
        });

        // Currencies
        Route::group([
            'prefix' => 'categories'
        ], function () {

            Route::get('/', [
                'as' => 'index',
                'uses' => 'CategoriesController@index',
            ]);
        });

        // Orders
        Route::group([
            'prefix' => 'orders'
        ], function () {

            Route::get('/', [
                'as' => 'index',
                'uses' => 'OrdersController@index',
            ]);

            Route::post('/create', [
                'as' => 'create',
                'uses' => 'OrdersController@create',
            ]);

            Route::get('/check/{id}', [
                'as' => 'checkStatus',
                'uses' => 'OrdersController@checkStatus',
            ]);
            Route::get('/detail/{id}', [
                'as' => 'show',
                'uses' => 'OrdersController@show',
            ]);
        });
    });

    // Items
    Route::group([
        'prefix' => 'items'
    ], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'ItemsController@index',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'index',
            'uses' => 'ItemsController@index',
        ]);
    });

    // Currencies
    Route::group([
        'prefix' => 'currencies'
    ], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'CurrenciesController@index',
        ]);
    });

    // Currencies
    Route::group([
        'prefix' => 'categories'
    ], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'CategoriesController@index',
        ]);
    });

    // Orders
    Route::group([
        'prefix' => 'orders'
    ], function () {

        Route::get('/', [
            'as' => 'index',
            'uses' => 'OrdersController@index',
        ]);

        Route::post('/create', [
            'as' => 'create',
            'uses' => 'OrdersController@store',
        ]);

        Route::get('/check', [
            'as' => 'checkStatus',
            'uses' => 'OrdersController@checkStatus',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'show',
            'uses' => 'OrdersController@show',
        ]);
    });

});