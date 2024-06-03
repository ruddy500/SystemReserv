<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\Horarios;
use App\Models\Fechas;
use App\Models\PeriodosSeleccionado;
use App\Models\ReservasAmbiente;
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
       // dd($checkboxValues);
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
            // $fechaRegistro = Fechas::where('dia',$dia)->where('mes',$mes)->where('anio',$anio)->first();
        //     $res = ReservasAmbiente::where('reservas_id',$idReserva)->get();
        //    // $res = ReservasAmbiente::find($idReserva);
        //     dd($res);
            $reserva = Reservas::find($idReserva); //extraemos la reserva actual
            $idDocente = $reserva->docentes_id;
            $DocenteAux = Usuarios::find($idDocente);

            $correoEmisor = "Administrador";
            //buscamos el correo del docente
            $correoDestino = $DocenteAux->email;

            $Asunto = "Sugerencia de solicitud de Reserva";
            $Contenido = "Estimado/a. \nEsperemos que este mensaje te encuentre muy bien.\nTe escribimos desde el Sistema de Reservas FCyT.\nDebido a que no encontramos un ambiente disponible para su solicitud de reserva, le sugerimos las siguientes alternativas:";
            // Recuperar los valores seleccionados en los checkboxes
            $checkboxValuesArray = is_array($checkboxValues) ? $checkboxValues : explode(',', $checkboxValues);
        
            if (count($checkboxValuesArray) >= 2) {
                $valor1 = intval($checkboxValuesArray[0]);
                $valor2 = intval($checkboxValuesArray[1]);

                // Ahora puedes usar $valor1 y $valor2 según sea necesario
                // ...
            }
            $periodosSelecReserva = PeriodosSeleccionado :: where('reservas_id',$idReserva)->get();
            $fechaReserva = $reserva->fecha;
            //dd($periodosSelecReserva,$fechaReserva);
            $partes_F = explode('-', $fechaReserva);
            $dia = (int) $partes_F[0]; 
            $mes = (int) $partes_F[1];
            $anio = (int) substr($partes_F[2], -2);
            $fechaRegistro = Fechas::where('dia',$dia)->where('mes',$mes)->where('anio',$anio)->first();
            $idFechaReserva = $fechaRegistro->id;
          //  dd( $periodosSelecReserva, $fechaReserva, $partes_F, $fechaRegistro, $idFechaReserva);
            
            $registroRAMB = new ReservasAmbiente();
            $registroRAMB->ambientes_id = $valor1;
            $registroRAMB->reservas_id = (int) $idReserva;
            $registroRAMB->save() ;

            $registroRAMB2 = new ReservasAmbiente();
            $registroRAMB2->ambientes_id = $valor2;
            $registroRAMB2->reservas_id = (int) $idReserva;
            $registroRAMB2->save() ;
            // dd($registroRAMB, $registroRAMB2);
            // $res = ReservasAmbiente::where('reservas_id',$idReserva)->get();

            // $res = ReservasAmbiente::find($idReserva);
            //  dd($res);
            if(count($periodosSelecReserva)== 1){
                $idPeriodo = $periodosSelecReserva[0]->periodos_id;
                $horariosAmbiente = Horarios::where('ambientes_id',$valor1)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo)->first();
                $horariosAmbiente->Estado = 0;
                // dd($horariosAmbiente,$reserva);
                $horariosAmbiente->save();

                $idPeriodo = $periodosSelecReserva[0]->periodos_id;
                $horariosAmbiente = Horarios::where('ambientes_id',$valor2)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo)->first();
                $horariosAmbiente->Estado = 0;
                // dd($horariosAmbiente,$reserva);
                $horariosAmbiente->save();

                $reserva->Estado = "sugerido";
                $reserva->save();
            }else{
                $idPeriodo = $periodosSelecReserva[0]->periodos_id;
                $horariosAmbiente = Horarios::where('ambientes_id',$valor1)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo)->first();
                $horariosAmbiente->Estado = 0;
                $horariosAmbiente->save();

                $idPeriodo = $periodosSelecReserva[0]->periodos_id;
                $horariosAmbiente = Horarios::where('ambientes_id',$valor2)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo)->first();
                $horariosAmbiente->Estado = 0;
                $horariosAmbiente->save();

                $idPeriodo2 = $periodosSelecReserva[1]->periodos_id;
                $horariosAmbiente2 = Horarios::where('ambientes_id',$valor1)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo2)->first();
                $horariosAmbiente2->Estado = 0;
                $horariosAmbiente2->save();

                $idPeriodo2 = $periodosSelecReserva[1]->periodos_id;
                $horariosAmbiente2 = Horarios::where('ambientes_id',$valor2)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo2)->first();
                $horariosAmbiente2->Estado = 0;           
                $horariosAmbiente2->save();
              
                $reserva->Estado = "sugerido";
                $reserva->save();

            }
          //  dd($valor1,$valor2);
            // dd($idReserva, $checkboxValues, $tipoSeleccionado);
            return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado', 'correoEmisor', 'correoDestino', 'Asunto','Contenido'));
        }elseif ($tipoSeleccionado == 'rechazar') {
            // dd();
            $reserva = Reservas::find($idReserva); //extraemos la reserva actual
            $idDocente = $reserva->docentes_id;
            $DocenteAux = Usuarios::find($idDocente);

            $correoEmisor = "Administrador";
            //buscamos el correo del docente
            $correoDestino = $DocenteAux->email;
            $Asunto = "Rechazo de solicitud de Reserva";
            $Contenido = "Estimado/a. \n¡Esperamos que este mensaje te encuentre muy bien!.\nTe escribimos desde el Sistema de Reservas FCyT.\nDebido a la no existencia de ambientes para su solicitud de reserva se informa que su solicitud ha sido rechazada.";
            // eliminar la reserva de pendientes
            
            // $reserva->delete();

            return view('mensajes.correo', compact('menu', 'idReserva', 'checkboxValues', 'tipoSeleccionado', 'correoEmisor', 'correoDestino', 'Asunto','Contenido')); 
         } else {
            // Si no se cumple ninguna de las condiciones, redirigir a la misma vista con un mensaje de error
            return back()->with('error', 'Tipo de acción no válido');
        }
    }
}