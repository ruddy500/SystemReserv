@extends('reservas/admin/principal')

@section('contenido-asignadas')
<?php 
    use App\Models\ReservasAmbiente;
    use App\Models\NombreAmbientes;
    use App\Models\Ambientes;
    use App\Models\Reservas;
    use App\Models\Usuarios;
    use App\Models\PeriodosSeleccionado;
    use App\Models\Periodos;

    $reservasAsig = Reservas::where('Estado', "asignado")->get();
    $reservasAmbiente = ReservasAmbiente::all();
    $ambientes = Ambientes::all();
    $nombreAmbientes = NombreAmbientes::all();
?>

<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
            <table class="table table-striped table-hover table-bordered">
                <thead class="bg-custom-lista">
                    <tr>
                        <th class="text-center h4 text-white">Ambiente</th>
                        <th class="text-center h4 text-white">Fecha</th>
                        <th class="text-center h4 text-white">Hora inicio</th>
                        <th class="text-center h4 text-white">Hora fin</th>
                        <th class="text-center h4 text-white">Docente</th>
                        <th class="text-center h4 text-white">Opciones</th>
                    </tr>
                </thead>
                
                <tbody> 
                    @foreach ($reservasAsig as $reserva)
                        @php
                            $idReserva = $reserva->id;
                            $tipo = $reserva->Tipo;
                            $fecha = $reserva->fecha;
                            $docenteId = $reserva->docentes_id;
                            $buscarDocente = Usuarios::where('id', $docenteId)->first();
                            $nombreDocente = $buscarDocente->name;

                            $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id', $idReserva)->get();
                            $tamPeriodosSeleccionado = count($periodosSeleccionados);
                            $horaInicio = '';
                            $horaFin = '';

                            if ($tamPeriodosSeleccionado > 0) {
                                $periodoId = $periodosSeleccionados[0]->periodos_id;
                                $periodoBuscar = Periodos::where('id', $periodoId)->first();
                                $partes_P = explode('-', $periodoBuscar->HoraIntervalo);
                                $horaInicio = trim(str_replace(' ', '', $partes_P[0]));

                                if ($tamPeriodosSeleccionado > 1) {
                                    $periodoId2 = $periodosSeleccionados[1]->periodos_id;
                                    $periodoBuscar2 = Periodos::where('id', $periodoId2)->first();
                                    $partes_P2 = explode('-', $periodoBuscar2->HoraIntervalo);
                                    $horaFin = trim(str_replace(' ', '', $partes_P2[1]));
                                } else {
                                    $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                                }
                            }
                        @endphp

                        @foreach ($reservasAmbiente->where('reservas_id', $idReserva) as $registroRA)
                            @php
                                $idAmbiente = $registroRA->ambientes_id;
                                $registroAMB = $ambientes->firstWhere('id', $idAmbiente);
                                $idNombreAMB = $registroAMB->nombre_ambientes_id;
                                $registroNombAMB = $nombreAmbientes->firstWhere('id', $idNombreAMB);
                                $nombreAMB = $registroNombAMB->Nombre;
                            @endphp
                            
                            <tr>
                                <td class="text-center h4 text-black">{{ $nombreAMB }}</td>
                                <td class="text-center h4 text-black">{{ $fecha }}</td>
                                <td class="text-center h4 text-black">{{ $horaInicio }}</td>
                                <td class="text-center h4 text-black">{{ $horaFin }}</td>
                                <td class="text-center h4 text-black">{{ $nombreDocente }}</td>
                                <td class="text-center h4 text-black">
                                    <div class="d-flex justify-content-center">
                                        <div class="circle2">
                                            @if ($tipo == 'individual')
                                                <a href="{{ route('reservas.verIndividual', ['idReserva' => $idReserva]) }}" class="btn btn-fab" title="Ver"> 
                                                    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                                </a>
                                            @elseif ($tipo == 'grupal')
                                                <a href="{{ route('reservas.verGrupal', ['idReserva' => $idReserva]) }}" class="btn btn-fab" title="Ver"> 
                                                    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
