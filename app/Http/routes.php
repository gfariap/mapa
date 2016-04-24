<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group([ 'middleware' => [ 'web', 'auth' ] ], function () {
    Route::group([ 'prefix' => 'empreendimentos', 'as' => 'empreendimentos.' ], function () {
        Route::get('/', [ 'as' => 'index', 'uses' => 'EmpreendimentosController@index' ]);
        Route::get('incluir', [ 'as' => 'create', 'uses' => 'EmpreendimentosController@create' ]);
        Route::get('{id}/editar', [ 'as' => 'edit', 'uses' => 'EmpreendimentosController@edit' ]);
        Route::get('{id}', [ 'as' => 'show', 'uses' => 'EmpreendimentosController@show' ]);
        Route::post('/', [ 'as' => 'store', 'uses' => 'EmpreendimentosController@store' ]);
        Route::put('{id}', [ 'as' => 'update', 'uses' => 'EmpreendimentosController@update' ]);
        Route::delete('{id}', [ 'as' => 'destroy', 'uses' => 'EmpreendimentosController@destroy' ]);

        Route::group([ 'prefix' => '{id}/colunas', 'as' => 'colunas.' ], function () {
            Route::get('incluir', [ 'as' => 'create', 'uses' => 'ColunasController@create' ]);
            Route::get('{coluna_id}/editar', [ 'as' => 'edit', 'uses' => 'ColunasController@edit' ]);
            Route::get('{coluna_id}', [ 'as' => 'show', 'uses' => 'ColunasController@show' ]);
            Route::post('/', [ 'as' => 'store', 'uses' => 'ColunasController@store' ]);
            Route::put('{coluna_id}', [ 'as' => 'update', 'uses' => 'ColunasController@update' ]);
            Route::delete('{coluna_id}', [ 'as' => 'destroy', 'uses' => 'ColunasController@destroy' ]);
        });
    });

    Route::group([ 'prefix' => 'anuncios', 'as' => 'anuncios.' ], function () {
        Route::get('/', [ 'as' => 'index', 'uses' => 'AnunciosController@index' ]);
        Route::get('incluir', [ 'as' => 'create', 'uses' => 'AnunciosController@create' ]);
        Route::get('{id}/editar', [ 'as' => 'edit', 'uses' => 'AnunciosController@edit' ]);
        Route::post('/', [ 'as' => 'store', 'uses' => 'AnunciosController@store' ]);
        Route::put('{id}', [ 'as' => 'update', 'uses' => 'AnunciosController@update' ]);
        Route::delete('{id}', [ 'as' => 'destroy', 'uses' => 'AnunciosController@destroy' ]);
    });
});

Route::group([ 'middleware' => 'web' ], function () {
    Route::auth();

    Route::get('/home', [ 'as' => 'home', 'uses' => 'HomeController@index' ]);
});

Route::get('{any?}', function ($any = null) {
    return redirect()->route('empreendimentos.index');
})->where('any', '.*');