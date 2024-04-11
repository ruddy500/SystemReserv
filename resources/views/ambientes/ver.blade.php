@extends('index')

@section('ambientes/ver')

<?php 
use App\Models\Dias;
use App\Models\Periodos; // Assuming you need Periodos model

$horario = $ambiente->horarios()->get();
?>

<!--{ {dd(get_defined_vars())}} -->

<div class="container mt-3">
		<div class="card vercard">
			<h3 class="card-header">Ambiente {{$ambiente->nombreambiente->Nombre}}</h3>
            <div class="card-body bg-content">
                <div class ="card details-card">
                    <h3 class="card-header details-header">Detalle de ambiente</h3>                                    
                    <div class="card-body bg-content">
                        <div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="table_encabezado_color">
                                        <td colspan="2">Detalle</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Nombre de Ambiente</td>
                                        <td style="width: 50%;">{{$ambiente->nombreambiente->Nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Capacidad</td>
                                        <td style="width: 50%;">{{$ambiente->Capacidad}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Descripción:
                                            <br>
                                            {{$ambiente->Ubicacion}}
                                        </td>
                                    </tr>
                                </tbody>                        
                            </table>
                            
                        <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                            <table id="horario-tabla" class="table caption-top">
                                <thead class="table_encabezado_color text-center">
                                    <td colspan="3">Horarios</td>
                                </thead>    
                            <thead class="text-center">
                                <tr>
                                    <th class="col">Día</th>
                                    <th scope="col">Horario</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>

                            <thead class="text-center">
                                
                            <!-- recorre el horario capturado y vamos obteniendo sus ids de dia y 
                              de periodo , luego buscamos su equivalencia -->
                              
                            @foreach ($horario as $fila)
                                @php
            
                                    $diaId = $fila->dias_id;
                                    $dia = Dias::find($diaId)->Dia;

                                    $periodoId = $fila->periodos_id;
                                    $periodo = Periodos::find($periodoId)->HoraIntervalo;
                                    
                                    $estado = ($fila->Estado) ? "Libre" : "Ocupado";
                                @endphp
                                
                                @if ($estado == "Libre")
                                    <tbody class="text-center">
                                        <tr>
                                        <td>{{ $dia }}</td>
                                        <td>{{ $periodo }}</td>
                                        <td>{{ $estado }}</td>
                                        </tr>
                                    </tbody>  
                                @endif
                                    
                            @endforeach
                         
                            

                                
                            </thead>
                        </table>

                        </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>        


@endsection