<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// home
Route::get("/{locale?}", "ComentarioController@index");
// inserção de comentários
Route::post("/{locale?}/inserir", "ComentarioController@insert");
// recuperar comentarios
Route::get("/{locale?}/comentarios/{date?}", "ComentarioController@all");
// recuperar dados para o gráfico
Route::get("/{locale?}/grafico", "ComentarioController@intervalos");
