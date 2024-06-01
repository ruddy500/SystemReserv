<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class MensajesController extends Controller
{
    // Métodos del controlador
    
    public function enviarCorreo(Request $request)
    {
        // Recuperar los datos del request
        $idReserva = $request->input('idReserva');
        $checkboxValues = $request->input('checkboxValues');
        $tipoSeleccionado = $request->input('tipoSeleccionado');
        
        $menu = view('componentes/menu'); // Crear la vista del menú

        // Verificar el valor de tipoSeleccionado y redirigir a diferentes vistas
        if ($tipoSeleccionado == 'asignar') {
            

            $reserva = Reservas::find($idReserva); //extraemos la reserva actual
            $idDocente = $reserva->docentes_id;
            $DocenteAux = Usuarios::find($idDocente);

            $correoEmisor = "Administrador";
            //buscamos el correo del docente
            $correoDestino = $DocenteAux->email;
            $Asunto = "Asignacion de solicitud de Reserva";
            $Contenido = "Estimado/a. \n¡Esperamos que este mensaje te encuentre muy bien!.\nTe escribimos desde el Sistema de Reservas FCyT.\nSe informa que su solicitud de reserva ha sido aceptada.";
            
            return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado', 'correoEmisor', 'correoDestino', 'Asunto','Contenido'));
        } elseif ($tipoSeleccionado == 'sugerir') {
            $reserva = Reservas::find($idReserva); //extraemos la reserva actual
            $idDocente = $reserva->docentes_id;
            $DocenteAux = Usuarios::find($idDocente);

            $correoEmisor = "Administrador";
            //buscamos el correo del docente
            $correoDestino = $DocenteAux->email;

            $Asunto = "Sugerencia de solicitud de Reserva";
            $Contenido = "Estimado/a. \n¡Esperamos que este mensaje te encuentre muy bien!.\nTe escribimos desde el Sistema de Reservas FCyT.\nDebido a que no encontramos un ambiente disponible para su solicitud de reserva, le sugerimos las siguientes alternativas:";

            return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado', 'correoEmisor', 'correoDestino', 'Asunto','Contenido'));
        } elseif ($tipoSeleccionado == 'rechazar') {
            // dd();
            $reserva = Reservas::find($idReserva); //extraemos la reserva actual
            $idDocente = $reserva->docentes_id;
            $DocenteAux = Usuarios::find($idDocente);

            $correoEmisor = "Administrador";
            //buscamos el correo del docente
            $correoDestino = $DocenteAux->email;
            $Asunto = "Rechazo de solicitud de Reserva";
            $Contenido = "Estimado/a. \n¡Esperamos que este mensaje te encuentre muy bien!.\nTe escribimos desde el Sistema de Reservas FCyT.\nDebido a la no existencia de ambientes para su solicitud de reserva se informa que su solicitud ha sido rechazada";
            // eliminar la reserva de pendientes
            
            // $reserva->delete();

            return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado', 'correoEmisor', 'correoDestino', 'Asunto','Contenido'));
        } else {
            // Si no se cumple ninguna de las condiciones, redirigir a la misma vista con un mensaje de error
            return back()->with('error', 'Tipo de acción no válido');
        }
    }
}