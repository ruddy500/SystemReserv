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

    $reservasAsig = Reservas::where('Estado',"asignado")->get();
    $tamanioReservas = count($reservasAsig);
    $reservasAmbiente = ReservasAmbiente::all();
    $ambientes = Ambientes::all();
    $nombreAmbientes = NombreAmbientes::all();
?>
{{-- {{ dd(get_defined_vars()) }} --}}

<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
            <table class="table table-striped table-hover table-bordered">
                <thead class="bg-custom-lista">
                    <tr>
                        <th class="text-center h4 text-white">Fecha</th>
                        <th class="text-center h4 text-white">Hora inicio</th>
                        <th class="text-center h4 text-white">Hora fin</th>
                        <th class="text-center h4 text-white">Docente</th>
                        <th class="text-center h4 text-white">Opciones</th>
                    </tr>
                </thead>
                
                <tbody> 

                    @for ( $i=0 ; $i < $tamanioReservas ; $i++)
                        <?php
                            $idReserva = $reservasAsig[$i]->id;
                            $tipo = $reservasAsig[$i]->Tipo;
                            $fecha = $reservasAsig[$i]->fecha;
                            
                            $registroRA =  $reservasAmbiente->firstWhere('reservas_id', $idReserva);
                            // dd($registroRA);
                            $idAmbiente = $registroRA->ambientes_id;
                            $registroAMB=  $ambientes->firstWhere('id', $idAmbiente);
                            // dd($registroAMB);
                            $idNombreAMB = $registroAMB->nombre_ambientes_id;
                            $registroNombAMB = $nombreAmbientes->firstWhere('id', $idNombreAMB);
                            // dd($registroNombAMB);
                            $nombreAMB = $registroNombAMB->Nombre;
                            // dd($nombreAMB);
                         
                            $docenteId = $reservasAsig[$i]->docentes_id;
                            // dd($docenteId);
                            $buscarDocente = Usuarios::where('id',$docenteId)->first();
                            // dd($docenteId);
                            $nombreDocente = $buscarDocente->name;
                            
                            $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
                            $tamPeriodosSeleccionado = count($periodosSeleccionados);
                            // dd($tamPeriodoSelec);

                            if($tamPeriodosSeleccionado == 1){
                                $periodoId = $periodosSeleccionados[0]->periodos_id;
                                
                                $periodoBuscar = Periodos :: where('id',$periodoId)->first();
                                $periodo = $periodoBuscar->HoraIntervalo;
                                $partes_P = explode('-', $periodo);
                                // if($i==2){dd($partes_P);}
                                
                                $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
                                $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                            
                                // if($i==2){ dd($horaInicio,$horaFin);}
                                // dd($horaInicio,$horaFin);
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
                
                         <!-- Fila blanca -->
                        <thead class="bg-custom-lista-fila-blanco">
                            <tr>
                                <th class="text-center h4 text-black">{{ $nombreAMB }}</th>
                                <th class="text-center h4 text-black">{{ $fecha }}</th>
                                <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                                <th class="text-center h4 text-black">{{ $horaFin }}</th>
                                
                                <th class="text-center h4 text-black">

                                    <div class="d-flex justify-content-center">
                                        <div class="circle2">

                                            @if ($tipo=='individual')
                                                <a href="{{ route('reservas.verIndividual',['idReserva'=>$idReserva])}}" class="btn btn-fab" title="Ver"> 
                                                    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                                </a>
                                            @elseif($tipo=='grupal')
                                                <a href="{{ route('reservas.verGrupal',['idReserva'=>$idReserva])}}" class="btn btn-fab" title="Ver"> 
                                                    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                                </a>
                                            @endif

                                        </div>

                                    </div>
                                
                                </th>
                            </tr>	
                        </thead>



                    @endfor


                </tbody>
                
                           </table>
        </div>
    </div>
</div>
@endsection