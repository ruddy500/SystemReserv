@extends('index')
<?php
use App\Models\Ambientes;
// use App\Models\Reservas;
// use App\Models\Usuarios;
// use App\Models\Motivos;
// use App\Models\MateriasSeleccionado;
use App\Models\Materias;
use App\Models\PeriodosSeleccionado;
use App\Models\Periodos;
use App\Models\Notificaciones;
use App\Models\ReservasAmbiente;
use App\Models\NombreAmbientes;
use App\Models\TipoAmbientes;
use App\Models\DocentesMaterias;

use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente


?>

<?php 
    use App\Models\Reservas;
    use App\Models\Usuarios;
    use App\Models\Motivos;
    use App\Models\MateriasSeleccionado;
    $idReserva= $reservaId;
    $reserva = Reservas::find($idReserva); //extraemos la reserva actual
    

    $idDocente = $reserva->docentes_id;
    $DocenteAux = Usuarios::find($idDocente);
    $tipoReserva = $reserva->Tipo ; //vamos a mostrar el tipo de la reserva

    $MotivoId = $reserva->motivos_id;
    $motivo = Motivos::find($MotivoId); //encontramos el motivo de la reserva
    
    $registrosMatSelec = MateriasSeleccionado::where('reservas_id',$idReserva)->get();
    // dd($registrosMatSelec);
    $idMateria = $registrosMatSelec[0]->materias_id;
    $registroMateria = Materias::where('id',$idMateria)->first();
    $nombreMateria = $registroMateria->Nombre;    
    // dd($nombreMateria);

    // vamos a ver los peridos seleccionados
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
        //dd($partes_P,$partes_P2);

        $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
        $horaFin = trim(str_replace(' ', '', $partes_P2[1]));
        }

        
    ?>

<?php
$timezone = 'America/La_Paz';

$notificacion = Notificaciones::where('id', $notificacionId)->first();

$fecha = Carbon::parse($notificacion->fecha_actual_sistema)->setTimezone('America/La_Paz'); // Convertimos a la zona horaria correcta
$fechaActual = Carbon::now('America/La_Paz'); // Nos aseguramos que ambas fechas estén en la misma zona horaria

$fechaFormateada = $fecha->locale('es')->isoFormat('dddd, D [de] MMMM');
$diferencia = $fecha->diffForHumans($fechaActual);
?>

<?php 
// Configurar Carbon para usar el idioma español
Carbon::setLocale('es');
// hora en el que llego la notificacion 
$notificacionllego = Carbon::parse($notificacion->fecha_respuesta_Sugerencia, 'America/La_Paz');

// Obtener la fecha y hora actual en la misma zona horaria
$fechaActual = Carbon::now('America/La_Paz');

// Calcular la diferencia en tiempo
$diferencia2 = $notificacionllego->diffForHumans($fechaActual);
// dd($diferencia2);
// Formatear la fecha
$fechaFormateada2 = $notificacionllego->locale('es')->isoFormat('dddd, D [de] MMMM');
?>

@section('notificaciones/admin/sugerencia')
<div class="container mt-3">
    <div class="card vercard">
        <!-- ASUNTO DE LA SUGERENCIA ACEPTADA O RECHAZADA-PONER -->
        <h3 class="card-header">Sugerencia de solicitud de reserva aceptada</h3>
        <div class="card-body bg-content">
            <!-- FECHA DE LLEGADA DE NOTIFICACION -->
            <div class="notifLLegada" style="display: flex; justify-content: flex-end;">
                <small class="fechaLlegada">{{ $notificacionllego }} ({{ $diferencia2 }})</small>
            </div>
            <!-- MENSAJE O MOTIVO INSERTADO AL ENVIAR CORREO -->
            <div class="contenido-mensaje" style="max-width: 30rem; margin: auto;">
                <p style="margin-bottom: 5px;">Estimado/a Administrador.</p>
                <!-- PONER EL NOMBRE DEL DOCENTE  Y ACEPTADO O RECHAZADO-->
                <p style="margin-bottom: 5px;"> {{$DocenteAux->name}} a Aceptado o Rechazado la sugerencia de solicitud de reserva de ambientes:</p>
            </div>
            <hr>
            <div class="detalleReserva">
                <!-- DETALLE DE RESERVA -->
                <label for="detalle" class="col-form-label" style="font-weight: bold;">Detalle reserva ({{$tipoReserva}}):</label>
                <hr>
                <div class="tabla-Detalle">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">Nombre docente</td>
                                <td style="width: 50%;">{{$DocenteAux->name}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Cantidad de estudiantes</td>
                                <td style="width: 50%;">{{$reserva->CantEstudiante}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Motivo reserva</td>
                                <td style="width: 50%;">{{$motivo->Nombre}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Fecha</td>
                                <td style="width: 50%;">{{$reserva->fecha}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Periodo</td>
                                <td style="width: 50%;">{{ $horaInicio }} - {{ $horaFin }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Tipo de ambiente</td>
                                <td style="width: 50%;">{{$reserva->TipoAmbiente}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Materia</td>
                                <td style="width: 50%;">{{$nombreMateria}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Grupo(s)</td>
                                <?php
                                $gruposMateria = [];
                            ?>
                            @if ($tipoReserva == "individual")
                                @foreach ($registrosMatSelec as $registroMatSelec)
                                    <?php
                                        $idMateria = $registroMatSelec->materias_id;
                                        $materia = Materias::where('id',$idMateria)->first();
                                        $gruposMateria[] = $materia->Grupo;
                                    ?>
                                @endforeach
                                <td>{{ implode(', ', $gruposMateria) }}</td>
                            @else
                                @foreach ($registrosMatSelec as $registroMatSelec)
                                    <?php
                                        $idMateria = $registroMatSelec->materias_id;
                                        $materia = Materias::where('id',$idMateria)->first();
                                        
                                        $registroDocMat = DocentesMaterias::where('materias_id',$idMateria)->first();
                                        $idDocente = $registroDocMat->docentes_id;
                                        $registroDocente = Usuarios::where('id',$idDocente)->first();
                                        $nombreDocente = $registroDocente->name;
                                        
                                        $grupo = $materia->Grupo;
                                        $gruposMateria[] = "$grupo, $nombreDocente";
                                    ?>
                                @endforeach              
                                <td>
                                    @foreach($gruposMateria as $entry)
                                        {{ $entry }}<br>
                                    @endforeach
                                </td>
                            @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="detalleambiente">
                <!-- DETALLE DE AMBIENTE SUGERIDO -->
                <label for="detalle" class="col-form-label" style="font-weight: bold;">Detalle de sugerencia de ambiente:</label>
                <hr>
                <div class="tabladetalleambiente" style="max-height: 200px; overflow-y: auto;">
                    <?php
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
    // dd($nombresAmbientes, $capacidadesAmbientes,$ubicacionesAmbientes, $tiposAmbientes);
                ?>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                            <th scope="col">Ambiente</th>
                            <th scope="col">Capacidad</th>
                            <th scope="col">Ubicación</th>
                            <th scope="col">Tipo de ambiente</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th>{{$nombresAmbientes[0]}}</th>
                            <td>{{ $capacidadesAmbientes[0]}}</td>
                            <td>{{$ubicacionesAmbientes[0]}}</td>
                            <td>{{ $tiposAmbientes[0]}}</td>
                            <td>{{ $horaInicio }} - {{ $horaFin }}</td>
                            <td>{{ $fecha }}</td>
                            </tr>
                            <tr>
                                <th>{{$nombresAmbientes[1]}}</th>
                                <td>{{ $capacidadesAmbientes[1]}}</td>
                                <td>{{$ubicacionesAmbientes[1]}}</td>
                                <td>{{ $tiposAmbientes[1]}}</td>
                                <td>{{ $horaInicio }} - {{ $horaFin }}</td>
                                <td>{{ $fecha }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <!-- MENSAJE FINAL -->
            <div class="mensajeDespedida">
                <p style="margin-bottom: 5px;">Saludos</p>
            </div>
            <hr>
            <!-- MENSAJE POR DEFECTO -->
            <div class="mensajeAda" style="max-width: 30rem; margin: auto;">
                <p class="tamAda" style="font-size: 0.9rem;">Este mensaje ha sido generado automaticamente por el sistema de reservas. Si no esperabas este correo, o tienes alguna duda, por favor contáctanos.</p>
            </div>
        </div>
    </div>
</div>
@endsection