@extends('index')

@section('informes/informe')
{{-- {{ dd(get_defined_vars()) }} --}}
<?php
    use App\Models\Ambientes;
    use App\Models\Reservas;
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
    use App\Models\ConfiguracionCalendario;

    $reservasAmbientes = ReservasAmbiente::all();
    $configuraciones = ConfiguracionCalendario::all();

?>
<div class="container mt-3">
    <div class="card vercard">
        <h3 class="card-header">Informe de uso de ambientes</h3>
        <div class="card-body bg-content">
            <div class="Ambientesusados">
                <label class="col-form-label">Ambientes asignados gestión {{ isset($configuraciones[0]->Gestion) ? $configuraciones[0]->Gestion : '1-20XX' }} :</label>
            </div>
            <!-- TABLA DE AMBIENTES ASIGNADOS O USADOS -->
            <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="bg-custom-lista">
                        <tr>
                            <th class="text-center h4 text-white">Ambiente</th>
                            <th class="text-center h4 text-white">Fecha</th>
                            <th class="text-center h4 text-white">Periodo</th>
                            <th class="text-center h4 text-white">Materia</th>
                            <th class="text-center h4 text-white">Motivo</th>
                            <th class="text-center h4 text-white">Docente</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <thead class="bg-custom-lista-fila-blanco">

                            @foreach ($reservasAmbientes as $reservasAmbiente )
                               
                               <?php 
                                    $idReserva = $reservasAmbiente->reservas_id;
                                    $reserva = Reservas::where('id',$idReserva)->first();
                                    
                                    $idAmbiente = $reservasAmbiente->ambientes_id;
                                    $registroAmbiente = Ambientes::where('id',$idAmbiente)->first();
                                    $idNombreAmbiente = $registroAmbiente->nombre_ambientes_id;
                                    $registroNA = NombreAmbientes::where('id',$idNombreAmbiente)->first();
                                    $nombreAmbiente = $registroNA->Nombre;

                                    $fecha = $reserva->fecha;
    
                                    $motivoId = $reserva->motivos_id;
                                    $registroMotivo = Motivos::where('id',$motivoId)->first();
                                    $motivo = $registroMotivo->Nombre;

                                    $idDocente = $reserva->docentes_id;
                                    $registroDocente = Usuarios::where('id',$idDocente)->first();
                                    $nombreDocente = $registroDocente->name;

                                    $registrosMatSelec = MateriasSeleccionado::where('reservas_id',$idReserva)->get();
                                    //   $tamañoMatSelec = count($regiatrosMatSelec);
                                    $idMateria = $registrosMatSelec[0]->materias_id;

                                    $registroMateria = Materias::where('id',$idMateria)->first();
                                    $nombreMateria = $registroMateria->Nombre;

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

                               ?>

                                <tr>
                                    <th class="text-center h4 text-black">{{ $nombreAmbiente }}</th>
                                    <th class="text-center h4 text-black">{{ $fecha }}</th>
                                    <th class="text-center h4 text-black">{{ $horaInicio }} - {{ $horaFin }}</th>
                                    <th class="text-center h4 text-black">{{ $nombreMateria }}</th>
                                    <th class="text-center h4 text-black">{{ $motivo }}</th>
                                    <th class="text-center h4 text-black">{{ $nombreDocente }}</th>
                                </tr>
                                
                            @endforeach
                           
                            
                        </thead>
                    </tbody>
                </table>
            </div>
            <!-- PONER AQUI AMBIENTES MAS USADO Y MENOS USADO -->
            <div class="Ambientemasusado">
                <label class="col-form-label">
                    @if (isset($datos['ambienteMasUsado']) && !empty($datos['ambienteMasUsado']))
                        Ambiente más usado: {{ $datos['ambienteMasUsado']['ambiente'] }}
                        ({{ $datos['ambienteMasUsado']['cantidadApariciones'] }} 
                            @if ($datos['ambienteMasUsado']['cantidadApariciones'] == 1)
                                vez asignado
                            @else
                                veces asignado
                            @endif
                        )
                    @else
                        Ambiente más usado: No hay ambientes asignados
                    @endif  
                        
                </label>
            </div>
            
            <div class="Ambientemenosusado">
                <label class="col-form-label">
                    @if (isset($datos['ambienteMenosUsado']) && !empty($datos['ambienteMenosUsado']))
                        Ambiente menos usado: {{ $datos['ambienteMenosUsado']['ambiente'] }}
                        ({{ $datos['ambienteMenosUsado']['cantidadApariciones'] }} 
                            @if ($datos['ambienteMenosUsado']['cantidadApariciones'] == 1)
                                vez asignado
                            @else
                                veces asignado
                            @endif
                        )
                    @else
                        Ambiente menos usado: No hay ambientes asignados
                    @endif  
                
                </label>
            </div>
            <!-- TOP 10 DE LOS AMBIENTES MAS USADOS -->
            <!-- <div class="Ambientesusados">
                <label class="col-form-label">Top 10 ambientes más usados:</label>
            </div>
            <div class="graficoUsoAmbientes">
                <div class="chart"> -->
                    <!-- DATA-HEIGHT ES LAS VECES QUE SE USO UN AMBIENTE -->
                    <!-- <h2 class="chart-title">Ambientes</h2>
                    <div class="bar" data-height="80" data-tooltip="Auditorio">80</div>
                    <div class="bar" data-height="60" data-tooltip="690 A">60</div>
                    <div class="bar" data-height="40" data-tooltip="690 B">40</div>
                    <div class="bar" data-height="20" data-tooltip="691 B">20</div>
                    <div class="bar" data-height="70" data-tooltip="692 C">70</div>
                    <div class="bar" data-height="50" data-tooltip="692 D">50</div>
                    <div class="bar" data-height="30" data-tooltip="692 G">30</div>
                    <div class="bar" data-height="90" data-tooltip="693 A">90</div>
                    <div class="bar" data-height="10" data-tooltip="693 B">10</div>
                    <div class="bar" data-height="55" data-tooltip="Laboratorio">55</div>
                </div>
            </div> -->
            <div class="modal-footer btn-imprimir">
                <a href="{{ route('informe.pdf') }}" class="btn btn-primary submitBtn custom-btn">Imprimir PDF</a>
            </div>
        </div>
    </div>
</div>
<!-- CODIDO SCRIPT PARA EL GRAFICO ESTADISTICO -->
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const bars = document.querySelectorAll('.bar');
        bars.forEach((bar, index) => {
            const height = bar.getAttribute('data-height');
            setTimeout(() => {
                bar.style.height = height * 3 + 'px';
            }, index * 500);
        })
    })
</script> -->
@endsection