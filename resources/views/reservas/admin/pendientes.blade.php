@extends('reservas/admin/principal') 
@section('contenido-pendientes')
<?php
use App\Models\Reservas;
use App\Models\ReservasAmbiente;
use App\Models\NombreAmbientes;
use App\Models\Ambientes;
use App\Models\Fechas;
use App\Models\PeriodosSeleccionado;
use App\Models\Periodos;

$reservas = Reservas::all();
$reservasAmbiente = ReservasAmbiente::all();
$tamReservas = Reservas::count();
?>

<div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
	<table class="table table-striped table-hover table-bordered">
		<thead class="bg-custom-lista">
			<tr>
			    <th class="text-center h4 text-white">Ambiente</th>
				<th class="text-center h4 text-white">Fecha</th>
				<th class="text-center h4 text-white">Hora inicio</th>
				<th class="text-center h4 text-white">Hora fin</th>
                <th class="text-center h4 text-white">Opciones</th>
			</tr>
		</thead>
          
        @for ( $i = 0 ; $i < $tamReservas ;$i ++)
           <?php
                $idAmbiente = $reservasAmbiente[$i]->ambientes_id;
                $idReserva = $reservasAmbiente[$i]->reservas_id;

                $ambiente = Ambientes :: where('id',$idAmbiente)->first();

                $nombreId = $ambiente ->nombre_ambientes_id;
                $nombreBuscar = NombreAmbientes::where('id',$nombreId)->first();
                $nombre = $nombreBuscar->Nombre;

                $reserva = Reservas :: where('id',$idReserva)->first();
                
                $estadoReserva = $reserva->Estado;
                $idFecha = $reserva->fecha;
                //dd($idFecha);
                //dd($idFecha);
                $fechaBuscar = Fechas :: where('id',$idFecha)->first();
                //  if($i==3){
                //      dd($idFecha);
                //  }
                $fechaDia = $fechaBuscar ->dia;
                $fechaMes= $fechaBuscar ->mes;
                $fechaAnio= $fechaBuscar ->anio;
                
                $fecha = $fechaDia . '-' . $fechaMes . '-' . $fechaAnio;
                //dd($fecha);
                $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
                //dd(count($periodosSeleccionados));
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

                }
                    
           ?>
            
           @if ($i %2 == 0)
             
                @if ($estadoReserva == "pendiente")
                    <!-- Fila Ploma -->
                    <thead class="bg-custom-lista-fila-plomo">	
                        <tr>
                            <th class="text-center h4 text-black">{{ $nombre }}</th>
                            <th class="text-center h4 text-black">{{ $fecha }}</th>
                            <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                            <th class="text-center h4 text-black">{{ $horaFin }}</th>
                            <th class="text-center h4 text-black"></th>
                        </tr>
                    </thead>
                @endif
        
           @else
                @if ($estadoReserva == "pendiente")
                    <!-- Fila blanca -->
                    <thead class="bg-custom-lista-fila-blanco">
                        <tr>
                            <th class="text-center h4 text-black">{{ $nombre }}</th>
                            <th class="text-center h4 text-black">{{ $fecha }}</th>
                            <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                            <th class="text-center h4 text-black">{{ $horaFin }}</th>
                            <th class="text-center h4 text-black"></th>
                        </tr>	
                    </thead>

                @endif
            
           @endif
            
        
           	
        @endfor
        
    </table>
</div>
@endsection