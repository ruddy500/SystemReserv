<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbientesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\NombreAmbientesController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\RaizController;
use App\Models\Ambientes;

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
Route::post('/ambientes', [AmbientesController::class, 'guardar'])->name('guardar.ambiente');
Route::get('/ambientes/horario/{ambiente}', [HorariosController::class, 'mostrarHorario'])->name('ambientes.horario');
Route::post('/ambientes/horario/',[AmbientesController::class,'añadirHorario'])->name('ambientes.horario.añadir');
Route::get('/ambientes/ver/{nombre}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.ver');
Route::get('/ambientes/editar/{idAmbiente}', [AmbientesController::class, 'editarAmbiente'])->name('ambientes.editar');
Route::put('/ambientes/actualizar/{idAmbiente}', [AmbientesController::class, 'actualizarAmbiente'])->name('ambientes.actualizar');




