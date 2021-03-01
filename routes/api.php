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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categorias',     'App\Http\Controllers\CategoriaController@getCategoria');
Route::get('categorias/{id}','App\Http\Controllers\CategoriaController@getCategoriaId');
Route::post('addcategoria','App\Http\Controllers\CategoriaController@addCategoria');
Route::put('updatecategoria/{id}','App\Http\Controllers\CategoriaController@updateCategoria');