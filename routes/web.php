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

// Route::post('/reservas/registrar',[ReservasController::class,'registrar'])->name('reservas.consultarPeriodos');

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

Route::post('/reservas/pendientes', [ReservasAdminController::class, 'buscarReservas'])->name('reservas.pendientes.buscar');
// Ruta para la vista del docente
Route::get('/reservas', [ReservasController::class,'mostrar'])->name('reservas.principal');
Route::get('/reservas/asignadasDocente', [ReservasController::class,'asignadas'])->name('reservas.asignadasDocente');
Route::get('/reservas/pendientesDocente', [ReservasController::class,'pendientes'])->name('reservas.pendientesDocente');

Route::get('/reservas/registrarIndividual', [ReservasController::class,'registrar'])->name('reservas.registrarIndividual'); //parte de rudy


Route::get('/reservas/registrarGrupal', [ReservasController::class,'registrarGrupal'])->name('reservas.registrarGrupal');
Route::get('/reservas/formFinalIndividual', [ReservasController::class,'formFinalIndividual'])->name('reservas.formFinalIndividual');

// aqui se enviara los datos recepcionados en el formularios
Route::post('/reservas/formFinalIndividual', [ReservasController::class,'guardarIndividual'])->name('reservas.guardarIndividual');


Route::get('/reservas/formFinalGrupal', [ReservasController::class,'formFinalGrupal'])->name('reservas.formFinalGrupal');

//aqui se enviara lo de grupal
Route::post('/reservas/formFinalGrupal', [ReservasController::class,'guardarGrupal'])->name('reservas.guardarGrupal');

Route::get('/reservas/verIndividual/{idReserva}', [ReservasController::class,'verIndividual'])->name('reservas.verIndividual');   //parte de rudy

Route::get('/reservas/verGrupal/{idReserva}', [ReservasController::class,'verGrupal'])->name('reservas.verGrupal');//parte de Andrews
Route::get('/reservas/editar', [ReservasController::class,'editar'])->name('reservas.editar');

Route::post('/reservas/registrarGrupal',[ReservasController::class,'consultarMaterias'])->name('reservas.grupal.consultarMaterias');

Route::post('/reservas/registrarGrupal/tomarMaterias',[ReservasController::class,'enviarMaterias'])->name('reservas.grupal.tomarMaterias');

Route::post('/reservas/registrarIndividual/tomarMaterias',[ReservasController::class,'enviarMate'])->name('reservas.individual.tomarMaterias'); //materias individual

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
