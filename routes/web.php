<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    dd(DB::select('select * from CAACOM.separacao where codfilial in (1)'));
});

//TESTES
Route::get('/separacao', 'FakeController@separacao')->name('separacao');
Route::get('/expedicao', 'FakeController@expedicao')->name('expedicao');
Route::get('/separacao-expedicao', 'FakeController@separacaoExpedicao')->name('separacao-expedicao');

Route::get('/loja/{loja}', 'MonitaramentoController@index');
Route::get('/separacao/loja/{loja}', 'MonitaramentoController@emExpedicao')->name('get.expedicao');
Route::get('/expedicao/loja/{loja}', 'MonitaramentoController@emSeparacao')->name('get.separacao');


