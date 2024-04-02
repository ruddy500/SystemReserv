<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbientesController;
use App\Http\Controllers\InicioController;
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
Route::get('/ambientes', [AmbientesController::class, 'mostrar'])->name('ambientes.index');
Route::put('/ambiente-editar/{id}', [AmbientesController::class, 'editarAmbiente'])->name('editar.ambiente');


