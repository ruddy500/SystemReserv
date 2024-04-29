@extends('reservas/principal')

@section('contenido-pendientes')

<?php
use App\Models\Reservas;
use App\Models\Fechas;
use App\Models\Periodos;
use App\Models\Motivos;
use App\Models\PeriodosSeleccionado;

$reservas = Reservas::all();
$tamReservas = Reservas::count();
// dd($tamReservas);

?>

<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
        <table class="table table-striped table-hover table-bordered">
            <thead class="bg-custom-lista">
                <tr>
                    <th class="text-center h4 text-white">Fecha</th>
                    <th class="text-center h4 text-white">Hora inicio</th>
                    <th class="text-center h4 text-white">Hora fin</th>
                    <th class="text-center h4 text-white">Motivo</th>
                    <th class="text-center h4 text-white">Opciones</th>
                </tr>
            </thead>
            
            @for ( $i=0 ; $i < $tamReservas ; $i++)

                @if (auth()->user()->id == $reservas[$i]->docentes_id)

                    <?php
                    // *************** La fecha se guardarar en string y no en id no sera necesario buscar en fechas**********************
                        $idReserva = $reservas[$i]->id;
                        $idMotivo = $reservas[$i]->motivos_id;
                        $estadoReserva = $reservas[$i]->Estado;
                    //    dd("reserva",$idReserva,"fecha",$idFecha,"motivo",$idMotivo,"estado reserva",$estadoReserva);
                        //capturo los registros periodos seleccionados para esta reservas
                        $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
                        $tamPeriodosSeleccionado = count($periodosSeleccionados);
                        //capturo el registro del motivo seleccionado
                        $motivoSeleccionado = Motivos::where('id',$idMotivo)->first();
                        $motivo = $motivoSeleccionado->Nombre;
                        //capturo el registro de la fecha
                        $tipo = $reservas[$i]->Tipo;
                        $fecha = $reservas[$i]->fecha;
                       
                        if($tamPeriodosSeleccionado == 1){
                            $periodoId = $periodosSeleccionados[0]->periodos_id;
                            
                            $periodoBuscar = Periodos :: where('id',$periodoId)->first();
                            $periodo = $periodoBuscar->HoraIntervalo;
                            $partes_P = explode('-', $periodo);
                            // if($i==2){dd($partes_P);}
                            
                            $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
                            $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                          
                            // if($i==2){ dd($horaInicio,$horaFin);}

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
                           
                           

                    }
        
                    ?>
                    
                    @if ($i % 2 == 0)

                        @if ($estadoReserva == "pendiente")
                            <!-- Fila Ploma -->
                            <thead class="bg-custom-lista-fila-plomo">	
                                <tr>
                                    <th class="text-center h4 text-black">{{ $fecha }}</th>
                                    <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                                    <th class="text-center h4 text-black">{{ $horaFin }}</th>
                                    <th class="text-center h4 text-black">{{ $motivo }}</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <!-- SI ES RESERVA INDIVIDUAL SE MUESTRA ESTA HOJA DE VER -->
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
                                            <div class="circle3">
                                                <a href="{{ route('reservas.editar')}}" class="btn btn-fab" title="Editar">
                                                    <i class="fas fa-edit" style="color: white;"></i>  
                                                </a>
                                            </div>
                                                    
                                            <div class="circle5">
                                                <a href="#" class="btn btn-fab eliminar-reserva" title="Eliminar"> 
                                                    <i class="bi bi-trash3-fill" style="color: white;"></i>
                                                    <input type="hidden" class="id-reserva" value="">
                                                </a>						
                                            </div>
                            
                                        </div>
                                    </th>
                                </tr>
                            </thead> 
                    
                        @endif
                        
                        
                    @else

                        @if ($estadoReserva == "pendiente")
                            <!-- Fila blanca -->
                            <thead class="bg-custom-lista-fila-blanco">
                                <tr>
                                    <th class="text-center h4 text-black">{{ $fecha }}</th>
                                    <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                                    <th class="text-center h4 text-black">{{ $horaFin }}</th>
                                    <th class="text-center h4 text-black">{{ $motivo }}</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <!-- SI ES RESERVA GRUPAL SE MUESTRA ESTA HOJA DE VER -->
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
                                            <div class="circle3">
                                                <a href="{{ route('reservas.editar')}}" class="btn btn-fab" title="Editar">
                                                    <i class="fas fa-edit" style="color: white;"></i>  
                                                </a>
                                            </div>
                            
                                            <div class="circle5">
                                                <a href="#" class="btn btn-fab eliminar-reserva" title="Eliminar"> 
                                                    <i class="bi bi-trash3-fill" style="color: white;"></i>
                                                    <input type="hidden" class="id-reserva" value="">
                                                </a>						
                                            </div>

                                        </div>
                                    </th>
                                </tr>
                            </thead> 
                    
                        @endif
                    
                    @endif
                    
                @endif
                
               
                
            @endfor
        
           	
            
        </table>
    </div>
</div>
<!-- Agrega este bloque de script al final de tu archivo blade -->
<script>
    // Espera a que el documento esté completamente cargado
    $(document).ready(function() {
        // Maneja el clic en el botón de eliminar
        $('.eliminar-reserva').click(function() {
            // Muestra una alerta SweetAlert
            Swal.fire({
                title: '¿Está seguro que desea eliminar la solicitud de reserva??',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28AF06',
                cancelButtonColor: '#D30C1F',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Muestra un modal con el mensaje de éxito al borrar
                    Swal.fire({
                        title: 'Borrado con éxito',
                        text: 'La Reserva ha sido eliminado.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                    });
                }
            });
        });
    });
</script>
@endsection