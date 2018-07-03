<?php

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
    'namespace' => '\Unite\Transactions\Http\Controllers',
    'middleware' => ['api', 'auth:api', 'authorize'],
    'as' => 'api.'
], function ()
{
    Route::group(['as' => 'transaction.', 'prefix' => 'transaction'], function ()
    {
        Route::get('/',                             ['as' => 'list',                    'uses' => 'TransactionController@list']);
        Route::get('{id}',                          ['as' => 'show',                    'uses' => 'TransactionController@show']);
        Route::put('{id}',                          ['as' => 'update',                  'uses' => 'TransactionController@update']);
        Route::delete('{id}',                       ['as' => 'delete',                  'uses' => 'TransactionController@delete']);
    });

    Route::group(['as' => 'transactionSource.', 'prefix' => 'transactionSource'], function ()
    {
        Route::get('/',                             ['as' => 'list',                    'uses' => 'SourceController@list']);
        Route::get('{id}',                          ['as' => 'show',                    'uses' => 'SourceController@show']);
        Route::post('/',                            ['as' => 'create',                  'uses' => 'SourceController@create']);
        Route::put('{id}',                          ['as' => 'update',                  'uses' => 'SourceController@update']);
        Route::delete('{id}',                       ['as' => 'delete',                  'uses' => 'SourceController@delete']);
    });
});