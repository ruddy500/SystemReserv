<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use App\Models\Usuarios;
use App\Mail\Correo;
use App\Mail\Masivo;
use App\Models\Reservas;
use App\Models\Ambientes;
use App\Models\NombreAmbientes;
use App\Models\TipoAmbientes;
use App\Models\ReservasAmbiente;
use App\Models\Notificaciones;
use App\Models\PeriodosSeleccionado;
use App\Models\Horarios;
use App\Models\Fechas;
use App\Models\Motivos;
use App\Models\MateriasSeleccionado;
use App\Models\Materias;
use App\Models\Periodos;
use App\Models\DocentesMaterias;
use App\Models\UsuariosNotificacion;
use App\Models\Anuncios;
use App\Models\Reglas;
use Illuminate\Http\Request;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente



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
        $datosReserva = null;

        $andres=$reserva->Tipo;

        if($andres=="grupal"){ //grupal

            $correos=$reserva->docentes_grupal;
            $tamU=count($correos);

            $usuarios= Usuarios ::all(); //correos users
            $tamUs=$usuarios->count();

            if($tipoSeleccionado != "rechazar"){
                for($i=0;$i<$tamU;$i++){
                    $idDoc=$correos[$i];
                    for($j=0;$j<$tamUs;$j++){
                        if($usuarios[$j]->id==$idDoc){
                            $email=$usuarios[$j]->email;
                            $datosReserva = $this->getDatosReserva($idReserva);
                            Mail::to($email)->send(new Correo($details, $asunto,$tipoSeleccionado,$idReserva,$datosReserva));
                            //echo "$email<br>";
                        }
                    }
                }
            }else{
                for($i=0;$i<$tamU;$i++){
                    $idDoc=$correos[$i];
                    for($j=0;$j<$tamUs;$j++){
                        if($usuarios[$j]->id==$idDoc){
                            $email=$usuarios[$j]->email;
                            Mail::to($email)->send(new Correo($details, $asunto,$tipoSeleccionado,$idReserva,$datosReserva));
                            //echo "$email<br>";
                        }
                    }
                }
            }
        }else{//si es individual
            if($tipoSeleccionado != "rechazar"){
                $datosReserva = $this->getDatosReserva($idReserva);
                Mail::to($correoDestino)->send(new Correo($details, $asunto,$tipoSeleccionado,$idReserva,$datosReserva));
                
               }else{
                Mail::to($correoDestino)->send(new Correo($details, $asunto,$tipoSeleccionado,$idReserva,$datosReserva));
               }
        }
       
            
        
        

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.admin.asignadas', compact('menu'));
    }

    public function getDatosReserva($idReserva){

              $registroReserva = Reservas::where('id',$idReserva)->first();
              $tipoReserva = $registroReserva->Tipo ;
              
              $idDocente = $registroReserva->docentes_id;
              $registroDocente = Usuarios::where('id',$idDocente)->first();
              $nombreDocente = $registroDocente->name;

              $cantidadEstudiante = $registroReserva->CantEstudiante;

              $motivoId = $registroReserva->motivos_id;
              $registroMotivo = Motivos::where('id',$motivoId)->first();
              $motivo = $registroMotivo->Nombre;

              $fecha = $registroReserva->fecha;
              
              $tipoAmbiente = $registroReserva->TipoAmbiente;
            //  
              $registrosMatSelec = MateriasSeleccionado::where('reservas_id',$idReserva)->get();
            //   $tamañoMatSelec = count($regiatrosMatSelec);
              $idMateria = $registrosMatSelec[0]->materias_id;

              $registroMateria = Materias::where('id',$idMateria)->first();
              $nombreMateria = $registroMateria->Nombre;

              $periodosSelec = $this->getPeriodosSelec($idReserva);
              $datosAmbiente = $this->getDatosAmbiente($idReserva);

              $grupos = $this->getGrupo($tipoReserva,$registrosMatSelec);
            //   dd($grupos);
              return [
                'tipoReserva' => $tipoReserva,
                'nombreDocente' => $nombreDocente,
                'cantidadEstudiante'=>$cantidadEstudiante,
                'motivo'=>$motivo,
                'fecha'=>$fecha,
                'tipoAmbiente'=>$tipoAmbiente,
                'nombreMateria'=>$nombreMateria,
                'horas'=>$periodosSelec,
                'gruposMateria'=>$grupos ,
                'datosAmbiente'=>$datosAmbiente,
            ];

    }

    public function getDatosAmbiente($idReserva){
        $registroRA = ReservasAmbiente::where('reservas_id',$idReserva)->first();
        $idAmbiente = $registroRA->ambientes_id;
        $registroAmbiente = Ambientes::where('id',$idAmbiente)->first();
        
        $idNombreAmb = $registroAmbiente->nombre_ambientes_id;
        $registroNombreAmb = NombreAmbientes::where('id',$idNombreAmb)->first();
        $nombreAmbiente = $registroNombreAmb->Nombre;

        $capacidadAmbiente = $registroAmbiente->Capacidad;

        $ubicacionAmbiente = $registroAmbiente->Ubicacion;

        $idTipoAmb = $registroAmbiente->tipo_ambientes_id;
        $registroTipoAmb = TipoAmbientes::where('id',$idTipoAmb)->first();
        $tipoAmbiente = $registroTipoAmb->Nombre;


        return [
            'nombreAmbiente' => $nombreAmbiente,
            'capacidadAmbiente'=>$capacidadAmbiente ,
            'ubicacionAmbiente' => $ubicacionAmbiente,
            'tipoAmbiente'=> $tipoAmbiente  ,
        ];
    }

    public function getGrupo($tipoReserva,$registrosMatSelec){
                $gruposMateria = [];
        
                if ($tipoReserva == "individual") {
                    foreach ($registrosMatSelec as $registroMatSelec) {

                        $idMateria = $registroMatSelec->materias_id;
                        $materia = Materias::where('id',$idMateria)->first();
                        $gruposMateria[] = $materia->Grupo;
                
                    }
                    $gruposMateria = implode(',', $gruposMateria);
                } else {
                    foreach ($registrosMatSelec as $registroMatSelec) {
                        $idMateria = $registroMatSelec->materias_id;
                        $materia = Materias::where('id',$idMateria)->first();
                        
                        $registroDocMat = DocentesMaterias::where('materias_id',$idMateria)->first();
                        $idDocente = $registroDocMat->docentes_id;
                        $registroDocente = Usuarios::where('id',$idDocente)->first();
                        $nombreDocente = $registroDocente->name;
                        
                        $grupo = $materia->Grupo;
                        $gruposMateria[] = "$grupo, $nombreDocente";
                    }
                    $gruposMateria = implode("<br>", $gruposMateria);
                    
                }
                
                return $gruposMateria;

    }
    public function getPeriodosSelec($idReserva){

              $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
              $tamPeriodosSeleccionado = count($periodosSeleccionados);
               // dd($tamPeriodoSelec);
              if($tamPeriodosSeleccionado == 1){
                    $periodoId = $periodosSeleccionados[0]->periodos_id;
                    
                    $periodoBuscar = Periodos :: where('id',$periodoId)->first();
                    $periodo = $periodoBuscar->HoraIntervalo;
                    $partes_P = explode('-', $periodo);
                    
                    $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
                    $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                
              }else{

                    $periodoId = $periodosSeleccionados[0]->periodos_id;
                    $periodoId2 = $periodosSeleccionados[1]->periodos_id;

                    $periodoBuscar = Periodos :: where('id',$periodoId)->first();     
                    $periodoBuscar2 = Periodos :: where('id',$periodoId2)->first();

                    $periodo = $periodoBuscar->HoraIntervalo;
                    $periodo2 = $periodoBuscar2->HoraIntervalo;
                    
                    $partes_P = explode('-', $periodo);
                    $partes_P2 = explode('-', $periodo2);
                    //dd($partes_P,$partes_P2);

                    $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
                    $horaFin = trim(str_replace(' ', '', $partes_P2[1]));
                    
                    // if($i==1){dd($horaInicio,$horaFin);}
                
              }

              return [
                'horaInicio' => $horaInicio,
                'horaFin' => $horaFin,
            ];


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
        $contadorDeNotificaciones=0;
        for ($j = 0; $j < $tamCorreos; $j++) {
            for ($i = 0; $i < $tam; $i++) {
                if ($usuarios[$i]->id == $correos[$j]) {
                    $destino = $usuarios[$i]->email;
                    if($contadorDeNotificaciones===0){
                        //******notificaciones*****
                    $fechaEnvio = Carbon::now('America/La_Paz');
                    $fechaEnvio->addHours(4);
                    
                    $notificacion = new Notificaciones();
                    $notificacion->fecha_actual_sistema =  $fechaEnvio;
                    $notificacion->Estado =  "no leido";
                    $notificacion->tipo = "difusion";
                    
                    $notificacion->reservas_id = 0;
                    $notificacion->contenidoDifusion = $contenidoDifusion = json_encode([
                        'asunto' => $asunto,
                        'mensaje' => $mensaje
                    ]);
                    // dd($notificacion);
                    $notificacion->save();


                    $registroUR= new UsuariosNotificacion();
                    $registroUR->usuarios_id = $usuarios[$i]->id;
                    $registroUR->notificaciones_id = $notificacion->id;
                    $registroUR->save();
            
            
                    //**********************
                    $contadorDeNotificaciones=$contadorDeNotificaciones+1;
                    }
                    Mail::to($destino)->send(new  Masivo($details, $asunto));
                    //echo "$destino<br>";
                }
            }
        }
        //
        $anuncios = Anuncios::all();
        $tam = $anuncios->count();

        $reglas = Reglas::all();
        $t = $reglas->count();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('inicio',compact('menu','anuncios','tam','reglas','t'));
    }
}