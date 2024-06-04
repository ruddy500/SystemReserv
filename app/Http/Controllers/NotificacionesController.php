<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Notificaciones;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente

use Illuminate\Support\Facades\Mail;
use App\Mail\Sugerencia;

use App\Models\Ambientes;
use App\Models\Usuarios;
use App\Models\Motivos;
use App\Models\MateriasSeleccionado;
use App\Models\Materias;
use App\Models\PeriodosSeleccionado;
use App\Models\Periodos;
use App\Models\ReservasAmbiente;
use App\Models\NombreAmbientes;
use App\Models\TipoAmbientes;
use App\Models\DocentesMaterias;

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

    // para rechazar
    public function mostrarSugerenciaAdmin($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.admin.sugerenciaRechazo',compact('menu','reservaId','notificacionId'));
    }

    public function mostrarSugerenciaAdminAsignacion($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.admin.sugerenciaAsignacion',compact('menu','reservaId','notificacionId'));
    }

    public function sugerenciaRechazo(Request $request)
    {
        //enviar el correo
        $this->enviarCorreo($request,false);
        // dd($request->input('fecha_actual'));
        // Obtén los datos del formulario
        $notificacionId = $request->input('notificacion_id');
        $idReserva = $request->input('reserva_id');

        $reserva = Reservas::find($idReserva); //extraemos la reserva actual

        $reserva->Estado = "rechazado";
        $reserva->Fuesugerido='si';
        $reserva->save();

        $notificacion= Notificaciones::find($notificacionId);
        $notificacion->fecha_respuesta_Sugerencia=$request->input('fecha_actual2');
        $notificacion->save();


        // Redireccionar o devolver una respuesta
        return redirect()->route('notificaciones.lista');
    }

    public function sugerenciaAceptada(Request $request)
    {
        //enviar el correo
        $this->enviarCorreo($request,true);

        // Obtén los datos del formulario
        $notificacionId = $request->input('notificacion_id');
        $idReserva = $request->input('reserva_id');

        $reserva = Reservas::find($idReserva); //extraemos la reserva actual

        $reserva->Estado = "asignado";
        $reserva->Fuesugerido='si';
        $reserva->save();

        $notificacion= Notificaciones::find($notificacionId);
        $notificacion->fecha_respuesta_Sugerencia=$request->input('fecha_actual');
        $notificacion->save();

        // Redireccionar o devolver una respuesta
        return redirect()->route('notificaciones.lista');
    }

    public function enviarCorreo(Request $request, bool $boolean)
    {
        // --Enviar Datos al Mensaje--
        $asunto = 'Asignación de Solicitud de Reserva';
        $estado = $boolean ? 'Aceptado' : 'Rechazado'; // operador ternario  // true=Aceptado //false=Rechazado
        //Obtencion de datos
        $idReserva = $request->input('reserva_id'); //obtenemos el id
        $reserva = Reservas::find($idReserva); //extraemos la reserva actual

        $notificacionId = $request->input('notificacion_id');
        $notificacion= Notificaciones::find($notificacionId);

        $tipoReserva = $reserva->Tipo ; //vamos a mostrar el tipo de la reserva

        //detalles de la reserva
        $docente = Usuarios::find($reserva->docentes_id)->name;
        $cantidad = $reserva->CantEstudiante;
        $motivo = Motivos::find($reserva->motivos_id)->Nombre;
        $fecha = $reserva->fecha;
        $periodo = $this->Periodo($idReserva);
        $ambiente = $reserva->TipoAmbiente;
        $materia = Materias::where('id', MateriasSeleccionado::where('reservas_id', $idReserva)->first()->materias_id)->first()->Nombre;
        $grupo = $this->Grupo($tipoReserva,$idReserva);

        //obtener esa webada del Andres
        $datosAmbientes = $this->Ambiente($idReserva);

        //detalle del ambiente 1
        $ambiente1 = $datosAmbientes['nombresAmbientes'][0];
        $capacidad1 = $datosAmbientes['capacidadesAmbientes'][0];
        $ubicacion1 = $datosAmbientes['ubicacionesAmbientes'][0];
        $tipo1 = $datosAmbientes['tiposAmbientes'][0];
        $periodo1 = $this->Periodo($idReserva);
        $fecha1 = Carbon::parse($notificacion->fecha_actual_sistema)->setTimezone('America/La_Paz');
        //detalle del ambiente 2
        $ambiente2 = $datosAmbientes['nombresAmbientes'][1];
        $capacidad2 = $datosAmbientes['capacidadesAmbientes'][1];
        $ubicacion2 = $datosAmbientes['ubicacionesAmbientes'][1];
        $tipo2 = $datosAmbientes['tiposAmbientes'][1];
        $periodo2 = $this->Periodo($idReserva);
        $fecha2 = Carbon::parse($notificacion->fecha_actual_sistema)->setTimezone('America/La_Paz');
        //emisor
        $emisor = 'Administrador';
        //correo al que se enviara
        $correoDestino = 'adaenterprisesoft@gmail.com';

        // Detalles para el correo
        $details = [
            'estado' => $estado,

            'docente' => $docente,
            'cantidad' => $cantidad,
            'motivo' => $motivo,
            'fecha' => $fecha,
            'periodo' => $periodo,
            'ambiente' => $ambiente,
            'materia' => $materia,
            'grupo' => $grupo,

            'ambiente1' => $ambiente1,
            'capacidad1' => $capacidad1,
            'ubicacion1' => $ubicacion1,
            'tipo1' => $tipo1,
            'periodo1' => $periodo1,
            'fecha1' => $fecha1,

            'ambiente2' => $ambiente2,
            'capacidad2' => $capacidad2,
            'ubicacion2' => $ubicacion2,
            'tipo2' => $tipo2,
            'periodo2' => $periodo2,
            'fecha2' => $fecha2,

            'emisor' => $emisor
        ];
        // Enviar correo
        Mail::to($correoDestino)->send(new Sugerencia($details, $asunto));
    }

    public function Ambiente($reservaId)
    {
        $registrosRA = ReservasAmbiente::where('reservas_id',$reservaId)->get();
        // Inicializar arrays para almacenar los datos
        $nombresAmbientes = [];
        $capacidadesAmbientes = [];
        $ubicacionesAmbientes = [];
        $tiposAmbientes = [];
                    
        // Iterar sobre cada registro y obtener los detalles correspondientes
        foreach ($registrosRA as $registroRA) {
            $idAmbiente = $registroRA->ambientes_id;
            $registroAmbiente = Ambientes::where('id', $idAmbiente)->first();
                    
            $idNombreAmb = $registroAmbiente->nombre_ambientes_id;
            $registroNombreAmb = NombreAmbientes::where('id', $idNombreAmb)->first();
            $nombreAmbiente = $registroNombreAmb->Nombre;
            $nombresAmbientes[] = $nombreAmbiente;
                    
            $capacidadAmbiente = $registroAmbiente->Capacidad;
            $capacidadesAmbientes[] = $capacidadAmbiente;
                    
            $ubicacionAmbiente = $registroAmbiente->Ubicacion;
            $ubicacionesAmbientes[] = $ubicacionAmbiente;
                    
            $idTipoAmb = $registroAmbiente->tipo_ambientes_id;
            $registroTipoAmb = TipoAmbientes::where('id', $idTipoAmb)->first();
            $tipoAmbiente = $registroTipoAmb->Nombre;
            $tiposAmbientes[] = $tipoAmbiente;
        }

        return [
            'nombresAmbientes' => $nombresAmbientes,
            'capacidadesAmbientes' => $capacidadesAmbientes,
            'ubicacionesAmbientes' => $ubicacionesAmbientes,
            'tiposAmbientes' => $tiposAmbientes,
        ];
    }

    public function Grupo($tipoReserva,$idReserva){
        $registrosMatSelec = MateriasSeleccionado::where('reservas_id',$idReserva)->get(); 
        $gruposMateria = [];
        $dato = "";
                           
        if ($tipoReserva == "individual"){
            foreach ($registrosMatSelec as $registroMatSelec){                     
                $idMateria = $registroMatSelec->materias_id;
                $materia = Materias::where('id',$idMateria)->first();
                $gruposMateria[] = $materia->Grupo;                  
            }
            $dato = implode(', ', $gruposMateria); 
        }else{
            foreach ($registrosMatSelec as $registroMatSelec){               
                $idMateria = $registroMatSelec->materias_id;
                $materia = Materias::where('id',$idMateria)->first();
                                        
                $registroDocMat = DocentesMaterias::where('materias_id',$idMateria)->first();
                $idDocente = $registroDocMat->docentes_id;
                $registroDocente = Usuarios::where('id',$idDocente)->first();
                $nombreDocente = $registroDocente->name;
                                        
                $grupo = $materia->Grupo;
                $gruposMateria[] = "$grupo, $nombreDocente";               
            }              
            $dato = implode(' | ', $gruposMateria);                  
        }
        return $dato;
    }

    public function Periodo($idReserva){
        $horaInicio = "";
        $horaFin = "";
        $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
        $tamPeriodosSeleccionado = count($periodosSeleccionados);

        if($tamPeriodosSeleccionado == 1){
            $periodoId = $periodosSeleccionados[0]->periodos_id;
                        
            $periodoBuscar = Periodos :: where('id',$periodoId)->first();
            $periodo = $periodoBuscar->HoraIntervalo;
            $partes_P = explode('-', $periodo);
                        
            $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
            $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                    
        }
        else{

            $periodoId = $periodosSeleccionados[0]->periodos_id;
            $periodoId2 = $periodosSeleccionados[1]->periodos_id;

            $periodoBuscar = Periodos :: where('id',$periodoId)->first();     
            $periodoBuscar2 = Periodos :: where('id',$periodoId2)->first();

            $periodo = $periodoBuscar->HoraIntervalo;
            $periodo2 = $periodoBuscar2->HoraIntervalo;
                        
            $partes_P = explode('-', $periodo);
            $partes_P2 = explode('-', $periodo2);

            $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
            $horaFin = trim(str_replace(' ', '', $partes_P2[1]));
            }

            $variable = $horaInicio . ' - ' . $horaFin;

        return $variable;
    
    }
}