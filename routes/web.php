<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbientesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\NombreAmbientesController;
use App\Http\Controllers\RaizController;

/*
Route::get('/', function () {
    return view('componentes/menu');
});

Route::get('/inicio', function () {
    return view('inicio', ['menu' => view('componentes/menu')]);
})->name('inicio');
*/
/*Route::get('/ambientes', function () {
    return view('ambientes.index', ['menu' => view('componentes/menu')]);
})->name('ambientes.index');
*/

Route::get('/',[RaizController::class,'mostrar']);
Route::get('/inicio',[InicioController::class,'mostrar'])->name('inicio');
Route::get('/ambientes', [NombreAmbientesController::class, 'mostrar'])->name('ambientes.index');
Route::post('/ambiente-guardar', [AmbientesController::class, 'guardar'])->name('guardar.ambiente');


