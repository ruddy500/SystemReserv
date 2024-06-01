@extends('index')

@section('notificaciones/rechazo')
{{-- {{ dd(get_defined_vars()) }} --}}
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

<div class="container mt-3">
    <div class="card vercard">
        <!-- ASUNTO DE LA RECHAZO-->
        <h3 class="card-header">Rechazo de solicitud de reserva</h3>
        <div class="card-body bg-content">
            <!-- FECHA DE LLEGADA DE NOTIFICACION -->
            <div class="notifLLegada" style="display: flex; justify-content: flex-end;">
                <small class="fechaLlegada">
                    {{ $fechaFormateada }} ({{ $diferencia }})
                </small>
            </div>
            <!-- MENSAJE O MOTIVO INSERTADO AL ENVIAR CORREO -->
            <div class="contenido-mensaje" style="max-width: 30rem; margin: auto;">
                <p style="margin-bottom: 5px;">Estimado/a.</p>
                <p style="margin-bottom: 5px;">¡Esperamos que este mensaje le encuentre muy bien. Te escribimos desde el Sistema de Reservas FCyT.</p>
                <p style="margin-bottom: 5px;">Debido a la no existencia de ambientes para su solicitud de reserva se informa que su solicitud ha sido Rechazada.</p>
            </div>
            <hr>
            <div class="detalleReserva">
                <!-- DETALLE DE RESERVA -->
                <label for="detalle" class="col-form-label" style="font-weight: bold;">Detalle de reserva ({{$tipoReserva}}):</label>
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
                                {{-- <td style="width: 50%;">1, 2, si es grupal poner el nombre del docente y su grupo aqui</td> --}}
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
            <!-- MENSAJE FINAL -->
            <div class="mensajeDespedida">
                <p style="margin-bottom: 5px;">Agradecemos tu atención y estamos aqui para cualquier consulta.</p>
                <p style="margin-bottom: 5px;">Atentamente, Administración.</p>
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