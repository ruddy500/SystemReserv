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
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservasController;



Route::get('/',[RaizController::class,'mostrar'])->middleware('auth'); //inicio del proyecto
Route::get('/inicio',[InicioController::class,'mostrar'])->name('inicio');
Route::get('/ambientes', [NombreAmbientesController::class, 'mostrar'])->name('ambientes.index');
Route::post('/ambientes', [AmbientesController::class, 'guardar'])->name('guardar.ambiente');
Route::get('/ambientes/horario/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.horario');
Route::post('/ambientes/horario',[HorariosController::class,'añadirHorario'])->name('ambientes.horario.añadir');

Route::get('/ambientes/ver/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.ver');
Route::get('/ambientes/editar/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.editar');

Route::post('/ambientes/{id}/cambiar-estado', [AmbientesController::class, 'cambiarEstado']);
Route::post('/ambientes/editar/{idHorario}/{idAmbiente}/{idFecha}/cambiar-estado', [HorariosController::class, 'cambiarEstado']);

Route::put('/ambientes/editar/horario',[HorariosController::class,'actualizarPeriodo'])->name('actualizar.horario');
Route::put('/ambientes/actualizar/{idAmbiente}', [AmbientesController::class, 'actualizarAmbiente'])->name('ambientes.actualizar');

// RUTA PARA LA VISTA DE RESERVAS DEL ADMINISTRADOR
Route::get('/reservas/admin', [ReservasAdminController::class, 'mostrar'])->name('reservas.admin.principal');
Route::get('/reservas/asignadas', [ReservasAdminController::class, 'asignadas'])->name('reservas.asignadas');
Route::get('/reservas/pendientes', [ReservasAdminController::class, 'pendientes'])->name('reservas.pendientes');

// Ruta para la vista del docente
Route::get('/reservas', [ReservasController::class,'mostrar'])->name('reservas.principal');
Route::get('/reservas/asignadasDocente', [ReservasController::class,'asignadas'])->name('reservas.asignadasDocente');
Route::get('/reservas/pendientesDocente', [ReservasController::class,'pendientes'])->name('reservas.pendientesDocente');
Route::get('/reservas/registrar', [ReservasController::class,'registrar'])->name('reservas.registrar');
Route::get('/reservas/materias', [ReservasController::class,'materias'])->name('reservas.materias');
Route::get('/reservas/formFinal', [ReservasController::class,'formFinal'])->name('reservas.formFinal');


// Route::post('/login',[LoginController::class,'logear'])->name('loging');
/*Route::get('/login', function () {
    return view('auth/login');
})->name('login');
*/
Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('/login', [SessionsController::class, 'create'])
    ->middleware('guest')
    ->name('login.index');

Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');
