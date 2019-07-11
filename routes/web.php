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

//PAINEL
Route::get('/', "PainelController@dashboard");

//USERS
Route::resource('user', 'UsersController')->except(['destroy']);
Route::get('/user/destroy/{id}', 'UsersController@destroy');
//TIPOS
Route::resource('tipo', 'TiposController')->except(['destroy']);
Route::get('/tipo/destroy/{id}', 'TiposController@destroy');
//DIVIDAS
Route::resource('divida', 'DividasController')->except(['destroy']);
Route::get('/divida/destroy/{id}', 'DividasController@destroy');
//PAGAMENTOS
Route::resource('pagamento', 'PagamentosController')->except(['destroy']);
Route::get('/pagamento/destroy/{id}', 'PagamentosController@destroy');

//AUTH
Auth::routes();
