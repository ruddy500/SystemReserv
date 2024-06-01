<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Notificaciones;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente

class NotificacionesController extends Controller
{ 
    //CONTROLADORES DOCENTE
    public function mostrarLista(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.lista',compact('menu'));
    }
    public function mostrarSugerencia($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.sugerencia',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarAsignacion($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.asignacion',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarRechazo($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.rechazo',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarDifusion($notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú

        $timezone = 'America/La_Paz';
        $notificacion = Notificaciones::where('id', $notificacionId)->first();

        $fecha = Carbon::parse($notificacion->fecha_actual_sistema)->setTimezone($timezone);
        $fechaActual = Carbon::now($timezone);
        $contenidoDifusion = json_decode($notificacion->contenidoDifusion, true);

        // Ahora puedes acceder a 'asunto' y 'mensaje' desde $contenidoDifusion
        $asunto = $contenidoDifusion['asunto'];
        $mensaje = $contenidoDifusion['mensaje'];

        $fechaFormateada = $fecha->locale('es')->isoFormat('dddd, D [de] MMMM');
        $diferencia = $fecha->diffForHumans($fechaActual);
        return view('notificaciones.difusion',compact('menu','notificacionId','fechaFormateada','diferencia','mensaje','asunto'));
    }

    //CONTROLADORES ADMINISTRADOR
    public function mostrarListaAdmin(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.admin.lista',compact('menu'));
    }
    public function mostrarSugerenciaAdmin(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.admin.sugerencia',compact('menu'));
    }

    public function sugerenciaRechazo(Request $request)
    {
        // Obtén los datos del formulario
        $notificacionId = $request->input('notificacion_id');
        $idReserva = $request->input('reserva_id');

        $reserva = Reservas::find($idReserva); //extraemos la reserva actual

        $reserva->Estado = "rechazado";
        $reserva->Fuesugerido='si';
        $reserva->save();


        // Redireccionar o devolver una respuesta
        return redirect()->route('notificaciones.lista');
    }

   

}