@extends('index')

@section('ambientes/ver')

<?php 
//use App\Models\Dias;
use App\Models\Periodos; // Assuming you need Periodos model
use App\Models\Fechas;
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
                                    <!-- MOSTRAR CAMPO TIPO DE AMBIENTE -->
                                    <tr>
                                        <td style="width: 50%;">Tipo de ambiente</td>
                                        <td style="width: 50%;">{{$tipoAmbiente}}</td>
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
                                    <th class="col">Fecha</th>
                                    <th scope="col">Horario</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>

                            <thead class="text-center">
                                
                            <!-- recorre el horario capturado y vamos obteniendo sus ids de dia y 
                              de periodo , luego buscamos su equivalencia -->
                              
                            @foreach ($horario as $fila)
                                @php
            
                                    //  $fehchaId = $fila->fechas_id;
                                    //  $fechaId = Fechas::find($fechaId);
                                    //  $fechaId = $fechaId->dia;
                                    //  $fechaId = $fechaId->mes;
                                    //  $fechaId = $fechaId->anio;
                                    $fechaId = $fila->fechas_id;
                                    $fechaD = Fechas::find($fechaId)->dia;
                                    $fechaM = Fechas::find($fechaId)->mes;
                                    $fechaY = Fechas::find($fechaId)->anio;
                                    if($fechaD < 10){
                                        $fechaD = "0".$fechaD;
                                    }
                                    
                                    if($fechaM < 10){
                                        $fechaM = "0".$fechaM;
                                    }
                                    $fechaCompleta = $fechaD."-".$fechaM."-".$fechaY;
                                    //periodos
                                    $periodoId = $fila->periodos_id;  
                                    $periodo = Periodos::find($periodoId)->HoraIntervalo;
                                  //  dd($periodo);
                                    $estado = ($fila->Estado) ? "Libre" : "Ocupado";
                                @endphp
                                
                                @if ($estado == "Libre")
                                    <tbody class="text-center">
                                        <tr>
                                        <td>{{ $fechaCompleta }}</td>
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