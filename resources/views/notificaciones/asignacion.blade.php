@extends('index')

@section('notificaciones/asignacion')
{{-- {{ dd(get_defined_vars()) }} --}}
<?php
    //  notificacionId y reservaId
    use App\Models\UsuariosNotificacion;
    use App\Models\Notificaciones;
    use App\Models\Reservas;
    use App\Models\Motivos;
    use App\Models\MateriasSeleccionado;
    use App\Models\Materias;
    use App\Models\PeriodosSeleccionado;
    use App\Models\Periodos;
    use App\Models\Usuarios;
    use App\Models\DocentesMaterias;
    use App\Models\ReservasAmbiente;
    use App\Models\Ambientes;
    use App\Models\NombreAmbientes;
    use App\Models\TipoAmbientes;
    use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente

    $timezone = 'America/La_Paz';

    $notificacion = Notificaciones::where('id', $notificacionId)->first();

    $fecha = Carbon::parse($notificacion->fecha_actual_sistema)->setTimezone('America/La_Paz'); // Convertimos a la zona horaria correcta
    $fechaActual = Carbon::now('America/La_Paz'); // Nos aseguramos que ambas fechas estén en la misma zona horaria

    $fechaFormateada = $fecha->locale('es')->isoFormat('dddd, D [de] MMMM');
    $diferencia = $fecha->diffForHumans($fechaActual);
    // dd($diferencia);

?>

<div class="container mt-3">
    <div class="card vercard">
        <!-- ASUNTO DE LA ASIGNACION -->
        <h3 class="card-header">Asignación de solicitud de reserva</h3>
        <div class="card-body bg-content">
            <!-- FECHA DE LLEGADA DE NOTIFICACION -->
            <div class="notifLLegada" style="display: flex; justify-content: flex-end;">
                <small class="fechaLlegada">{{ $fechaFormateada }} ({{ $diferencia }})</small>
            </div>
            <!-- MENSAJE O MOTIVO INSERTADO AL ENVIAR CORREO -->
            <div class="contenido-mensaje" style="max-width: 30rem; margin: auto;">
                <p style="margin-bottom: 5px;">Estimado/a.</p>
                <p style="margin-bottom: 5px;">¡Esperamos que este mensaje le encuentre muy bien. Te escribimos desde el Sistema de Reservas FCyT.</p>
                <p style="margin-bottom: 5px;">Se informa que su solicitud de reserva ha sido Aceptada</p>
            </div>
            <hr>
            <div class="detalleReserva">
                <!-- DETALLE DE RESERVA -->
                <?php
                       $registroUN = UsuariosNotificacion::where('notificaciones_id',$notificacionId)->first();
                       $docenteId = $registroUN->usuarios_id;
                       $registroDocente = Usuarios::where('id',$docenteId)->first();
                       $nombreDocente = $registroDocente->name;

                       $registroReserva = Reservas::where('id',$reservaId)->first();
                       $cantidadEstudiante = $registroReserva->CantEstudiante;

                       $tipoReserva = $registroReserva->Tipo ;

                       $motivoId = $registroReserva->motivos_id;
                       $registroMotivo = Motivos::where('id',$motivoId)->first();
                       $motivo = $registroMotivo->Nombre;

                       $fechaReserva = $registroReserva->fecha;

                       $tipoAmbiente = $registroReserva->TipoAmbiente;
                        //  verificar
                       $registrosMatSelec = MateriasSeleccionado::where('reservas_id',$reservaId)->get();
                        //   $tamañoMatSelec = count($regiatrosMatSelec);
                       $idMateria = $registrosMatSelec[0]->materias_id;

                       $registroMateria = Materias::where('id',$idMateria)->first();
                       $nombreMateria = $registroMateria->Nombre;

                       $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$reservaId)->get();
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

                ?>
                <label for="detalle" class="col-form-label" style="font-weight: bold;">Detalle reserva ({{ $tipoReserva }}):</label>
                <hr>
                <div class="tabla-Detalle">
                    
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">Nombre docente</td>
                                <td style="width: 50%;">{{ $nombreDocente }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Cantidad de estudiantes</td>
                                <td style="width: 50%;">{{ $cantidadEstudiante }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Motivo reserva</td>
                                <td style="width: 50%;">{{ $motivo }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Fecha</td>
                                <td style="width: 50%;">{{ $fechaReserva }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Periodo</td>
                                <td style="width: 50%;">{{ $horaInicio }} - {{ $horaFin }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Tipo de ambiente</td>
                                <td style="width: 50%;">{{ $tipoAmbiente }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Materia</td>
                                <td style="width: 50%;">{{ $nombreMateria }}</td>
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
                <!-- DETALLE DE AMBIENTE ASIGNADO-->
                <label for="detalle" class="col-form-label" style="font-weight: bold;">Detalle de ambiente asignado:</label>
                <hr>
                <div class="tabladetalleambiente" style="max-height: 200px; overflow-y: auto;">
                    <?php
                        $registroRA = ReservasAmbiente::where('reservas_id',$reservaId)->first();
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
                            <th>{{ $nombreAmbiente }}</th>
                            <td>{{ $capacidadAmbiente }}</td>
                            <td>{{ $ubicacionAmbiente }}</td>
                            <td>{{ $tipoAmbiente }}</td>
                            <td>{{ $horaInicio }} - {{ $horaFin }}</td>
                            <td>{{ $fechaReserva }}</td>
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