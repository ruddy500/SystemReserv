<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbientesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\NombreAmbientesController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\RaizController;
use App\Models\Ambientes;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;

 Route::get('/',[RaizController::class,'mostrar'])->middleware('auth');

// Route::get('/', function () {
//     return view('home');
// })->middleware('auth');

// Route::get('/adminvistaAdmin')->name('vistaAdmin');

Route::get('/register', [RegisterController::class, 'create'])
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');

Route::get('/login', [SessionController::class, 'create'])
    ->middleware('guest')
    ->name('login.index');

Route::post('/login', [SessionController::class, 'store'])
    ->name('login.store');

Route::get('/logout', [SessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');


Route::get('/admin',[AdminController::class,'index'])
->middleware('auth.admin')
->name('admin.index');


// Route::get('/',[RaizController::class,'mostrar']);
Route::get('/inicio', [InicioController::class, 'mostrar'])->name('inicio');
Route::get('/ambientes', [NombreAmbientesController::class, 'mostrar'])->name('ambientes.index');
Route::post('/ambientes', [AmbientesController::class, 'guardar'])->name('guardar.ambiente');
Route::get('/ambientes/horario/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.horario');
Route::post('/ambientes/horario', [HorariosController::class, 'añadirHorario'])->name('ambientes.horario.añadir');

Route::get('/ambientes/ver/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.ver');
Route::get('/ambientes/editar/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.editar');

Route::post('/ambientes/{id}/cambiar-estado', [AmbientesController::class, 'cambiarEstado']);
Route::post('/ambientes/editar/{idHorario}/{idAmbiente}/{idDia}/cambiar-estado', [HorariosController::class, 'cambiarEstado']);

Route::put('/ambientes/editar/horario', [HorariosController::class, 'actualizarPeriodo'])->name('actualizar.horario');
Route::put('/ambientes/actualizar/{idAmbiente}', [AmbientesController::class, 'actualizarAmbiente'])->name('ambientes.actualizar');
