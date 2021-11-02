<?php

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
    return 'Biente.Shop';
});
Route::get('/bienteApiGet', 'IndexCTRL@bienteApiGet')->name('bienteApiGet');
Route::get('/bienteApiPost', 'IndexCTRL@bienteApiPost')->name('bienteApiPost');
Route::get('/productsOfUsers', 'IndexCTRL@productsOfUsers')->name('productsOfUsers');
