<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbientesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\NombreAmbientesController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\RaizController;
//IMPORTAR CONTROLADOR DE VISTA ADMIN
use App\Http\Controllers\ReservasAdminController;
use App\Models\Ambientes;


Route::get('/',[RaizController::class,'mostrar']);
Route::get('/inicio',[InicioController::class,'mostrar'])->name('inicio');
Route::get('/ambientes', [NombreAmbientesController::class, 'mostrar'])->name('ambientes.index');
Route::post('/ambientes', [AmbientesController::class, 'guardar'])->name('guardar.ambiente');
Route::get('/ambientes/horario/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.horario');
Route::post('/ambientes/horario',[HorariosController::class,'añadirHorario'])->name('ambientes.horario.añadir');

Route::get('/ambientes/ver/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.ver');
Route::get('/ambientes/editar/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.editar');

Route::post('/ambientes/{id}/cambiar-estado', [AmbientesController::class, 'cambiarEstado']);
Route::post('/ambientes/editar/{idHorario}/{idAmbiente}/{idDia}/cambiar-estado', [HorariosController::class, 'cambiarEstado']);

Route::put('/ambientes/editar/horario',[HorariosController::class,'actualizarPeriodo'])->name('actualizar.horario');
Route::put('/ambientes/actualizar/{idAmbiente}', [AmbientesController::class, 'actualizarAmbiente'])->name('ambientes.actualizar');

// RUTA PARA LA VISTA DE RESERVAS DEL ADMINISTRADOR
//Route::get('/reservas/admin', [ReservasAdminController::class, 'mostrar'])->name('reservas.admin.principal');
Route::get('/reservas/admin', [ReservasAdminController::class, 'mostrar'])->name('reservas.admin.principal');
Route::get('/reservas/asignadas', [ReservasAdminController::class, 'asignadas'])->name('reservas.asignadas');
Route::get('/reservas/pendientes', [ReservasAdminController::class, 'pendientes'])->name('reservas.pendientes');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
