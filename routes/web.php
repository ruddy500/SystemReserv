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
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\AvisosController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\AnunciosController;



Route::get('/',[RaizController::class,'mostrar'])->middleware('auth'); //inicio del proyecto
Route::get('/inicio',[InicioController::class,'mostrar'])->name('inicio');
Route::get('/ambientes', [NombreAmbientesController::class, 'mostrar'])->name('ambientes.index');
Route::post('/ambientes', [AmbientesController::class, 'guardar'])->name('guardar.ambiente');
Route::get('/ambientes/horario/{ambiente}', [AmbientesController::class, 'verAmbiente'])->name('ambientes.horario');
Route::post('/ambientes/horario',[HorariosController::class,'añadirHorario'])->name('ambientes.horario.añadir');

// aqui se importara el excel de lo importado
Route::post('/ambientes/importar', [AmbientesController::class, 'importExcel'])->name('import.excel');

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
//RUTA PARA VERIFICAR UNA RESERVA
Route::get('/reservas/verificar/{idReserva}', [ReservasAdminController::class,'verificar'])->name('reservas.verificar');   // rudy aqui eso de ver

Route::post('/reservas/verificar/{idReserva}', [ReservasAdminController::class, 'buscarAmbientesDisponibles'])->name('reservas.ambientes.buscar');

Route::post('/reservas/pendientes', [ReservasAdminController::class, 'buscarReservas'])->name('reservas.pendientes.buscar');
// Ruta para la vista del docente
Route::get('/reservas', [ReservasController::class,'mostrar'])->name('reservas.principal');
Route::get('/reservas/asignadasDocente', [ReservasController::class,'asignadas'])->name('reservas.asignadasDocente');
Route::get('/reservas/pendientesDocente', [ReservasController::class,'pendientes'])->name('reservas.pendientesDocente');

Route::get('/reservas/registrarIndividual', [ReservasController::class,'registrar'])->name('reservas.registrarIndividual'); //parte de rudy


Route::get('/reservas/registrarGrupal', [ReservasController::class,'registrarGrupal'])->name('reservas.registrarGrupal');
Route::get('/reservas/formFinalIndividual', [ReservasController::class,'formFinalIndividual'])->name('reservas.formFinalIndividual');  //form final individual

// aqui se enviara los datos recepcionados en el formularios
Route::post('/reservas/formFinalIndividual', [ReservasController::class,'guardarIndividual'])->name('reservas.guardarIndividual');  


Route::get('/reservas/formFinalGrupal', [ReservasController::class,'formFinalGrupal'])->name('reservas.formFinalGrupal');  //form final grupal

//aqui se enviara lo de grupal
Route::post('/reservas/formFinalGrupal', [ReservasController::class,'guardarGrupal'])->name('reservas.guardarGrupal');  

Route::get('/reservas/verIndividual/{idReserva}', [ReservasController::class,'verIndividual'])->name('reservas.verIndividual');   //parte de rudy

Route::get('/reservas/verGrupal/{idReserva}', [ReservasController::class,'verGrupal'])->name('reservas.verGrupal');
Route::get('/reservas/editar/{idReserva}', [ReservasController::class,'editar'])->name('reservas.editar');
Route::put('/reservas/actualizar/{idReserva}', [ReservasController::class, 'actualizarReserva'])->name('reserva.actualizar');

Route::post('/reservas/registrarGrupal',[ReservasController::class,'consultarMaterias'])->name('reservas.grupal.consultarMaterias');//materias grupal
Route::post('/reservas/registrarGrupal/tomarMaterias',[ReservasController::class,'enviarMaterias'])->name('reservas.grupal.tomarMaterias');

Route::post('/reservas/registrarIndividual',[ReservasController::class,'consultarMaterias'])->name('reservas.individual.consultarMaterias'); //materias individual
Route::post('/reservas/registrarIndividual/tomarMaterias',[ReservasController::class,'enviarMaterias'])->name('reservas.individual.tomarMaterias');

Route::get('/reservas/pendientesDocente/{idReserva}',[ReservasController::class,'eliminarPendiente']); //elimina la reserva pendiente (no dormi :V)
//RUTA PARA REDIRIGIR A LA VISTA DEL MENSAJE DE CORREO
Route::get('/mensajes/correo',[MensajesController::class,'enviarCorreo'])->name('mensajes.correo');

Route::post('/enviar-correo', [CorreoController::class, 'enviarCorreo'])->name('enviarCorreo'); //enviar correos (no dormi:v)

//RUTA PARA VER LA LISTA DE NOTIFICACIONES DOCENTE
Route::get('/notificaciones/lista',[NotificacionesController::class,'mostrarLista'])->name('notificaciones.lista');
Route::get('/notificaciones/sugerencia/{reservaId}/{notificacionId}',[NotificacionesController::class,'mostrarSugerencia'])->name('notificaciones.sugerencia');

//aqui se recepsionara el rechazo de solicitud de sugerencia
Route::post('/notificaciones/sugerenciaRechazo', [NotificacionesController::class,'sugerenciaRechazo'])->name('notificaciones.sugerenciaRechazo');  

//aqui se recepsionara el aceptacion de solicitud de sugerencia
Route::post('/notificaciones/sugerenciaAceptada', [NotificacionesController::class,'sugerenciaAceptada'])->name('notificaciones.sugerenciaAceptada');  

Route::get('/notificaciones/asignacion/{reservaId}/{notificacionId}',[NotificacionesController::class,'mostrarAsignacion'])->name('notificaciones.asignacion');
Route::get('/notificaciones/rechazo/{reservaId}/{notificacionId}',[NotificacionesController::class,'mostrarRechazo'])->name('notificaciones.rechazo');
Route::get('/notificaciones/difusion/{notificacionId}',[NotificacionesController::class,'mostrarDifusion'])->name('notificaciones.difusion');


//RUTA PARA VER LA LISTA DE NOTIFICACIONES ADMINISTRADOR
Route::get('/notificaciones/admin/lista',[NotificacionesController::class,'mostrarListaAdmin'])->name('notificaciones.admin.lista');

Route::get('/notificaciones/admin/sugerenciaRechazo/{reservaId}/{notificacionId}',[NotificacionesController::class,'mostrarSugerenciaAdmin'])->name('notificaciones.admin.sugerenciaRechazo');

Route::get('/notificaciones/admin/sugerenciaAsignacion/{reservaId}/{notificacionId}',[NotificacionesController::class,'mostrarSugerenciaAdminAsignacion'])->name('notificaciones.admin.sugerenciaAsignacion');


//RUTA PARA MOSTRAR AVISOS
Route::get('/avisos/aviso',[AvisosController::class,'mostrar'])->name('avisos.aviso');

Route::post('/enviar-correo-masivo', [CorreoController::class, 'enviarCorreoMasivo'])->name('enviarCorreoMasivo'); //enviar correos masivos (no dormi:v)

//RUTA PARA MOSTRAR INFORMES
Route::get('/informes/informe',[InformesController::class,'mostrar'])->name('informes.informe');

Route::get('/informes/pdf', [InformesController::class, 'generarPDF'])->name('informe.pdf');

//RUTA PARA ANUNCIOS
Route::get('/anuncios', [AnunciosController::class, 'mostrar'])->name('anuncios.index');

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
