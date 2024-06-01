<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use App\Models\Usuarios;
use App\Mail\Correo;
use App\Mail\Masivo;
use App\Models\Reservas;
use App\Models\ReservasAmbiente;
use App\Models\Notificaciones;
use App\Models\PeriodosSeleccionado;
use App\Models\Horarios;
use App\Models\Fechas;
use App\Models\UsuariosNotificacion;
use Illuminate\Http\Request;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente
date_default_timezone_set('America/La_Paz');


class CorreoController extends Controller
{

    public function enviarCorreo(Request $request)
    {   //entra aqui primero cuando se le da a enviar 
        // dd($request->all());
        // Recibir datos del formulario
        $asunto = $request->input('asunto');
        $mensaje = $request->input('mensaje');
        $correoDestino = $request->input('enviar');
        $emisor = $request->input('emisor');
        $tipoSeleccionado = $request->input('tipo_seleccionado');
        $idReserva = $request->input('idReserva');
        $ambientesSeleccionado = $request->input('ambientes_seleccionado');
        // dd($tipoSeleccionado);
        // Detalles para el correo
        $details = [
            'title' => $asunto,
            'emisor' => $emisor,
            'body' => $mensaje
        ];

        //***** Creacion de notificaciones *****
    
        $reserva = Reservas::where('id',$idReserva)->first(); 
        $idDocente = $reserva->docentes_id;

        $fechaEnvio = Carbon::now('America/La_Paz');
        $fechaEnvio->addHours(4);
        
        $notificacion = new Notificaciones();
        $notificacion->fecha_actual_sistema =  $fechaEnvio;
        $notificacion->Estado =  "no leido";

        switch ($tipoSeleccionado) {
            case 'asignar':
                $notificacion->Tipo = "asignacion";

            //     //****** Cambia estado de asignar ******
                $reserva = Reservas::find($idReserva);
                $idAmbiente = intval($ambientesSeleccionado); 
                $periodosSelecReserva = PeriodosSeleccionado :: where('reservas_id',$idReserva)->get();
                $fechaReserva = $reserva->fecha;
                $partes_F = explode('-', $fechaReserva);
                $dia = (int) $partes_F[0]; 
                $mes = (int) $partes_F[1];
                $anio = (int) substr($partes_F[2], -2);
                $fechaRegistro = Fechas::where('dia',$dia)->where('mes',$mes)->where('anio',$anio)->first();
                $idFechaReserva = $fechaRegistro->id;
                
                $registroRAMB = new ReservasAmbiente();
                $registroRAMB->ambientes_id = $idAmbiente;
                $registroRAMB->reservas_id = (int) $idReserva;
                $registroRAMB->save() ;
                // dd($registroRAMB);
                if(count($periodosSelecReserva)== 1){
                    $idPeriodo = $periodosSelecReserva[0]->periodos_id;
                    $horariosAmbiente = Horarios::where('ambientes_id',$idAmbiente)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo)->first();
                    $horariosAmbiente->Estado = 0;
                    // dd($horariosAmbiente,$reserva);
                    $horariosAmbiente->save();

                    $reserva->Estado = "asignado";
                    $reserva->save();
                }else{
                    $idPeriodo = $periodosSelecReserva[0]->periodos_id;
                    $horariosAmbiente = Horarios::where('ambientes_id',$idAmbiente)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo)->first();
                    $horariosAmbiente->Estado = 0;
                    $horariosAmbiente->save();

                    $idPeriodo2 = $periodosSelecReserva[1]->periodos_id;
                    $horariosAmbiente2 = Horarios::where('ambientes_id',$idAmbiente)->where('fechas_id',$idFechaReserva)->where('periodos_id',$idPeriodo2)->first();
                    $horariosAmbiente2->Estado = 0;
                
                    $horariosAmbiente2->save();
                
                    $reserva->Estado = "asignado";
                    $reserva->save();

                }
                //*******************************************
                
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

        //luego entra aqui segundo correo.php
        // Enviar correo
        Mail::to($correoDestino)->send(new Correo($details, $asunto,$tipoSeleccionado,$idReserva));
        

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.admin.principal', compact('menu'));
    }

    public function enviarCorreoMasivo(Request $request){
        //obtener la tabla users
        $usuarios = Usuarios::all();
        $tam = $usuarios->count();
        // Recibir datos del formulario
        $emisor = $request->input('emisor');
        $asunto = $request->input('asunto');
        $mensaje = $request->input('mensaje');
        $correos = $request->input('correos');

        // Detalles para el correo
        $details = [
            'title' => $asunto,
            'emisor' => $emisor,
            'body' => $mensaje
        ];

        //tamanio de los correos seleccionados
        $tamCorreos = count($correos);

        // Iterar sobre cada correo en $correos y luego enviar los correos
        for ($j = 0; $j < $tamCorreos; $j++) {
            for ($i = 0; $i < $tam; $i++) {
                if ($usuarios[$i]->id == $correos[$j]) {
                    $destino = $usuarios[$i]->email;
                    Mail::to($destino)->send(new  Masivo($details, $asunto));
                    //echo "$destino<br>";
                }
            }
        }
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.admin.principal', compact('menu'));  
    }
}