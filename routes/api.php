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

Route::group(['middleware' => ['guest:api']], function() {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('login/refresh', 'Auth\LoginController@refresh');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('register', 'Auth\RegisterController@register');
});

Route::group(['middleware' => ['jwt']], function() {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('me', 'Auth\LoginController@me');

    Route::post('upload/file', 'UploadController@file');
    Route::post('upload/base64_image', 'UploadController@base64_image');
    Route::post('upload/delete', 'UploadController@delete');

    Route::apiResource('lugar', 'LugarController');
    Route::get('lugar/fill/{param}', 'LugarController@fill');

    Route::apiResource('catalogo', 'CatalogoController');
    Route::get('catalogo/fill/{param}', 'CatalogoController@fill');

    Route::apiResource('categoria', 'CategoriaController');
    Route::get('categoria/fill/{param}', 'CategoriaController@fill');

    Route::apiResource('comentario', 'ComentarioController');
    Route::get('comentario/fill/{param}', 'ComentarioController@fill');

    Route::apiResource('departamento', 'DepartamentoController');
    Route::get('departamento/fill/{param}', 'LugarController@fill');

    Route::apiResource('informacion', 'InformacionController');
    Route::get('informacion/fill/{param}', 'InformacionController@fill');

    Route::apiResource('pedido', 'PedidoController');
    Route::get('pedido/fill/{param}', 'PedidoController@fill');

    Route::apiResource('producto', 'ProductoController');
    Route::get('producto/fill/{param}', 'ProductoController@fill');

    Route::apiResource('promotora', 'PromotoraController');
    Route::get('promotora/fill/{param}', 'PromotoraController@fill');

    Route::apiResource('subcategoria', 'SubcategoriaController');
    Route::get('subcategoria/fill/{param}', 'SubcategoriaController@fill');

    Route::apiResource('tienda', 'TiendaController');
    Route::get('tienda/fill/{param}', 'TiendaController@fill');
});

