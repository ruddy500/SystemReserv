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
    return view('componentes/menu');
});

Route::get('/inicio', function () {
    return view('inicio', ['menu' => view('componentes/menu')]);
})->name('inicio');

Route::get('/ambientes', function () {
    return view('ambientes.index', ['menu' => view('componentes/menu')]);
})->name('ambientes.index');




