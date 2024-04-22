@extends('index')

@section('reservas/ver')
<?php
use App\Models\Reservas;
use App\Models\ReservasAmbiente;
use App\Models\NombreAmbientes;
use App\Models\Ambientes;
use App\Models\Fechas;
use App\Models\PeriodosSeleccionado;
use App\Models\Periodos;

$reservas = Reservas::all();
// $reservasAmbiente = ReservasAmbiente::all();
// $ambiente = Ambientes::all();

// Aquí colocas el idReserva que quieres buscar un registro
$reservaAmbiente = ReservasAmbiente::where('reservas_id', $idReserva)->first();
$idAmbiente = $reservaAmbiente->ambientes_id;

$ambiente = Ambientes::where('id', $idAmbiente)->first();
$idNombreAmbiente = $ambiente->nombre_ambientes_id;

// aqui se busca el nombre del ambiente
$nombreAmbiente = NombreAmbientes::where('id',$idNombreAmbiente)->first();
// dd($nombreAmbiente->Nombre);


// aqui se busca la reserva
$reserva = Reservas::where('id', $idReserva)->first();
$motivoReserva = $reserva->Motivo;
// dd($motivoReserva)


// aqui se buscara la fecha
$idFecha = $reserva->fecha;
// dd($idFecha);

$fechaBuscar = Fechas :: where('id',$idFecha)->first();
$fechaDia = $fechaBuscar ->dia;
$fechaMes= $fechaBuscar ->mes;
$fechaAnio= $fechaBuscar ->anio;
$fecha = $fechaDia . '-' . $fechaMes . '-' . $fechaAnio;
// dd($fecha);


// ahora veremos los peridos seleccionados 
$periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
$tamPeriodosSeleccionado = count($periodosSeleccionados);
             
             if($tamPeriodosSeleccionado == 1){
                $periodoId = $periodosSeleccionados[0]->periodos_id;
                
                $periodoBuscar = Periodos :: where('id',$periodoId)->first();
                $periodo = $periodoBuscar->HoraIntervalo;
                $partes_P = explode('-', $periodo);
                // if($i==3){dd($partes_P);}
                
                $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
                $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                // if($i==3){dd($horaInicio,$horaFin);}
                $unido = $horaInicio.' - '.$horaFin;

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
            //dd($horaInicio,$horaFin);
            //xd
             $unido = $horaInicio.' - '.$horaFin;

             }
 
// dd($unido)
?>
<div class="container mt-3">
		<div class="card vercard">
			<h3 class="card-header">Reservas</h3>
            <div class="card-body bg-content">
                <div class ="card details-card">
                    <h3 class="card-header details-header">Detalle de reserva</h3>                                    
                    <div class="card-body bg-content">
                        <div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="table_encabezado_color">
                                        <td colspan="2">Detalle</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Nombre docente</td>
                                        <td style="width: 50%;">{{auth()->user()->name}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Nombre ambiente</td>
                                        <td style="width: 50%;">{{$nombreAmbiente->Nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Motivo de reserva</td>
                                        <td style="width: 50%;">{{$motivoReserva}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Cantidad de estudiantes</td>
                                        <td style="width: 50%;">{{$reserva->CantEstudiante}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Fecha</td>
                                        <td style="width: 50%;">{{$fecha}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Periodo</td>
                                        <td style="width: 50%;">{{$unido}}</td>
                                    </tr>
                                </tbody>                        
                            </table>
                            <!-- TABLA DE DETALLE DE RESERVA -->
                            <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                            <table id="horario-tabla" class="table caption-top table-bordered ">
                                <thead class="table_encabezado_color text-center">
                                    <td colspan="3">Detalle de materia</td>
                                    <thead class="text-center">
                                        <tr>
                                            <th class="col" style="width: 70%;">Materia</th>
                                            <th scope="col" style="width: 30%;">Grupo</th>
                                        </tr>
                                    </thead>
                                    @for ($i = 0; $i < $tam; $i++)
                                        @if($seleccionado[$i]->reservas_id == $idReserva)
                        
                                        <thead class="text-center">
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>{{$materias[$seleccionado[$i]->materias_id-1]->Nombre}}</td>
                                                    <td>{{$materias[$seleccionado[$i]->materias_id-1]->Grupo}}</th></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Introducción a la programación</td>
                                                    <td>2</td>
                                                </tr>
                                                <tr>
                                                    <td>Introducción a la programación</td>
                                                    <td>2</td>
                                                </tr> -->
                                            </tbody> 
                                        </thead>
                                        @endif
				                    @endfor
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection