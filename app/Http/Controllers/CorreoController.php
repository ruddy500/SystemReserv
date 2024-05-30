<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\Correo;
use App\Models\Reservas;
use App\Models\Notificaciones;
use App\Models\UsuariosNotificacion;
use Illuminate\Http\Request;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente
date_default_timezone_set('America/La_Paz');


class CorreoController extends Controller
{

    public function enviarCorreo(Request $request)
    {
        // dd($request->all());
        // Recibir datos del formulario
        $asunto = $request->input('asunto');
        $mensaje = $request->input('mensaje');
        $correoDestino = $request->input('enviar');
        $emisor = $request->input('emisor');
        $tipoSeleccionado = $request->input('tipo_seleccionado');
        $idReserva = $request->input('idReserva');
        // dd($tipoSeleccionado);
        // Detalles para el correo
        $details = [
            'title' => $asunto,
            'emisor' => $emisor,
            'body' => $mensaje
        ];

        // Enviar correo
        Mail::to($correoDestino)->send(new Correo($details, $asunto,$tipoSeleccionado,$idReserva));
        
        //***** Creacion de notificaciones *****
    
        $reserva = Reservas::where('id',$idReserva)->first(); 
        $idDocente = $reserva->docentes_id;

        $fechaEnvio = Carbon::now('America/La_Paz');
        // Formatear la fecha de envío
        $fechaEnvioFormateada = $fechaEnvio->locale('es')->isoFormat('D [de] MMMM');
        
        $notificacion = new Notificaciones();
        $notificacion->fecha_actual_sistema =  $fechaEnvioFormateada;
        $notificacion->Estado =  "no leido";
        switch ($tipoSeleccionado) {
            case 'asignar':
                $notificacion->Tipo = "asignacion";
                break;
            
            case 'sugerir':
                $notificacion->Tipo = "sugerencia";
                break;
                
            default:
            $notificacion->Tipo = "rechazado";
                break;
        }

        $notificacion->reservas_id = $idReserva;
        // dd($notificacion);
        $notificacion->save();

        $registroUR= new UsuariosNotificacion();
        $registroUR->usuarios_id = $idDocente;
        $registroUR->notificaciones_id = $notificacion->id;
        $registroUR->save();
        // dd($registroUR);

        //**************************************

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.admin.principal', compact('menu'));
    }
}