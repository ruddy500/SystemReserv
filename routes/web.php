<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbientesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\NombreAmbientesController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\RaizController;
use App\Models\Ambientes;


Route::get('/',[RaizController::class,'mostrar']);
Route::get('/inicio',[InicioController::class,'mostrar'])->name('inicio');
Route::get('/ambientes', [NombreAmbientesController::class, 'mostrar'])->name('ambientes.index');
Route::post('/ambientes', [AmbientesController::class, 'guardar'])->name('guardar.ambiente');
Route::get('/ambientes/horario/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.horario');
Route::post('/ambientes/horario',[HorariosController::class,'añadirHorario'])->name('ambientes.horario.añadir');

Route::get('/ambientes/ver/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.ver');
Route::get('/ambientes/editar/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.editar');

