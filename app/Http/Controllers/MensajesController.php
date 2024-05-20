<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class MensajesController extends Controller
{
    // Métodos del controlador
    // public function enviarCorreo(Request $request)
    // {
    //     //aqui se esta recuperando el idReserva , los ambientes seleccionados 
    //     //y un diferenciador que sera de tipo string con los valores de asignar , sugerir y rechazar
    //     //aqui se haran las modificaciones con un if then else
    //     //tambien se tendra que enviar a la vista un tipo de identificador para hacer 
    //     //los diferentes tipos de mensaje

    //     // dd($request->all());
    //     $idReserva = $request->input('idReserva');

    //     $checkboxValue = $request->input('checkboxValues');

    //     $tipoSeleccionado = $request->input('tipoSeleccionado');

    //     $menu = view('componentes/menu'); // Crear la vista del menú
    //     // Verificar el valor de tipoSeleccionado y redirigir a diferentes vistas
    //     if ($tipoSeleccionado == 'asignar') {
    //         return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado'));
    //     }

    //     // Verificar el valor de tipoSeleccionado y redirigir a diferentes vistas
    //     if ($tipoSeleccionado == 'sugerir') {
    //         return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado'));
    //     }

    //     // Verificar el valor de tipoSeleccionado y redirigir a diferentes vistas
    //     if ($tipoSeleccionado == 'rechazar') {
    //         return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado'));
    //     }



    //     // return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValue', 'tipoSeleccionado'));
    // }

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

            $correoEmisor = "Administrador@gmail.com";
            //buscamos el correo del docente
            $correoDestino = $DocenteAux->email;
            $Asunto = "Asignacion de solicitud de Reserva";

            return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado', 'correoEmisor', 'correoDestino', 'Asunto'));
        } elseif ($tipoSeleccionado == 'sugerir') {
            $reserva = Reservas::find($idReserva); //extraemos la reserva actual
            $idDocente = $reserva->docentes_id;
            $DocenteAux = Usuarios::find($idDocente);

            $correoEmisor = "Administrador@gmail.com";
            //buscamos el correo del docente
            $correoDestino = $DocenteAux->email;

            $Asunto = "Sugerencia de solicitud de Reserva";

            return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado', 'correoEmisor', 'correoDestino', 'Asunto'));
        } elseif ($tipoSeleccionado == 'rechazar') {
            // dd();
            $reserva = Reservas::find($idReserva); //extraemos la reserva actual
            $idDocente = $reserva->docentes_id;
            $DocenteAux = Usuarios::find($idDocente);

            $correoEmisor = "Administrador@gmail.com";
            //buscamos el correo del docente
            $correoDestino = $DocenteAux->email;
            $Asunto = "Rechazo de solicitud de Reserva";
            return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado', 'correoEmisor', 'correoDestino', 'Asunto'));
        } else {
            // Si no se cumple ninguna de las condiciones, redirigir a la misma vista con un mensaje de error
            return back()->with('error', 'Tipo de acción no válido');
        }
    }
}
