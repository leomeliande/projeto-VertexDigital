<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('contatos', 'ContatoController@index');
Route::get('contato/busca/id/{id}', 'ContatoController@showId');
Route::get('contato/busca/nome/{nome}', 'ContatoController@showNome');
Route::get('contato/busca/email/{email}', 'ContatoController@showEmail');
Route::post('contato/novo', 'ContatoController@store');
Route::delete('contato/{id}', 'ContatoController@destroy');
