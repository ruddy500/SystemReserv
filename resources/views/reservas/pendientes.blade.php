@extends('reservas/principal')

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

    {{-- <form action="{{ route('ambientes.actualizar', $ambiente->id) }}" method="POST" novalidate class="row g-3 needs-validation"> --}}
        {{-- @method('PUT') --}}
        
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
       @for ( $i = 0 ; $i  < $tamReservas ; $i++)

       <?php
             $idAmbiente = $reservasAmbiente[$i]->ambientes_id;
             $idReserva = $reservasAmbiente[$i]->reservas_id;

             //dd("ambiente",$idAmbiente,"reservas",$idReserva);
             $ambiente = Ambientes :: where('id',$idAmbiente)->first();
             $nombreId = $ambiente ->nombre_ambientes_id;
             $nombreBuscar = NombreAmbientes::where('id',$nombreId)->first();
             $nombre = $nombreBuscar->Nombre;
             //dd($nombre);
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
             
        @if ($i % 2 == 0)
             <!-- Fila Ploma -->
             @if ($estadoReserva == "pendiente")
             <thead class="bg-custom-lista-fila-plomo">	
                <tr>
                    <th class="text-center h4 text-black">{{ $nombre }}</th>
                    <th class="text-center h4 text-black">{{ $fecha }}</th>
                    <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                    <th class="text-center h4 text-black">{{ $horaFin }}</th>
                    <th class="text-center h4 text-black">
                        <div class="d-flex justify-content-center">
                            <div class="circle2">
                                <a href="{{ route('reservas.ver',['idReserva'=>$idReserva])}}" class="btn btn-fab" title="Ver"> 
                                    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                </a>
                            </div>

                            {{-- ICONO DE EDITAR RESERVA --}}

                            <div class="circle3">
                                <a href="#" class="btn btn-fab" title="Editar" data-bs-toggle="modal" data-bs-target="#formularioEditReserva" data-idreserva="{{ $idReserva }}" data-bs-whatever="@mdo">
                                    <i class="fas fa-edit" style="color: white;"></i>  
                                </a>
                                @include('reservas.editar')
                            </div>
                            {{-- {{ dd(get_defined_vars()) }} --}}
                            {{-- <div class="circle3">
                                <a href="#" class="btn btn-fab" title="Editar" data-bs-toggle="modal" data-bs-target="#formularioEditReserva" data-bs-whatever="@mdo">
                                    <i class="fas fa-edit" style="color: white;"></i>  
                                 
                                </a>
                                @include('reservas.editar')
                            </div> --}}

                            {{-- <div class="circle4">
                                <a href="#" class="btn btn-fab" title="Editar" data-bs-toggle="modal" data-bs-target="#formularioHorario" data-fecha-id="{{ $fechaId }}" data-periodo-id="{{ $periodoId }}" data-ambiente-id="{{ $ambiente->id }}">
                                    
                                    <i class="fas fa-edit" style="color: white;"></i>
                                </a>
                            </div> --}}

                            <div class="circle5">
                                <a href="#" class="btn btn-fab" title="Eliminar" id="eliminar1"> 
                                <i class="bi bi-trash3-fill" style="color: white;"></i>
                                <input type="hidden" id="idReserva" value="{{ $idReserva }}">
                                </a>						
                            </div>

                            {{-- <div class="circle5">
                                <a href="#" class="btn btn-fab" title="Eliminar" id="eliminar2"> 
                                <i class="bi bi-trash3-fill" style="color: white;"></i>
                                <input type="hidden" id="idReserva" value="{{ $idReserva }}">
                                </a>						
                            </div> --}}

                        </div>
                    </th>
                </tr>
            </thead>
                
             @endif
        
        @else
            <!-- Fila blanca -->
            @if ($estadoReserva == "pendiente")
            <thead class="bg-custom-lista-fila-blanco">
                <tr>
                    <th class="text-center h4 text-black">{{ $nombre }}</th>
                    <th class="text-center h4 text-black">{{ $fecha }}</th>
                    <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                    <th class="text-center h4 text-black">{{ $horaFin }}</th>
                    <th class="text-center h4 text-black">
                        <div class="d-flex justify-content-center">
                            <div class="circle2">
                                <a href="{{ route('reservas.ver',['idReserva'=>$idReserva])}}" class="btn btn-fab" title="Ver"> 
                                    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                </a>
                            </div>
                            <div class="circle3">
                                <a href="#" class="btn btn-fab" title="Editar" data-bs-toggle="modal" data-bs-target="#formularioEditReserva" data-idreserva="{{ $idReserva }}">
                                    <i class="fas fa-edit" style="color: white;"></i>  
                                </a>
                                @include('reservas.editar')
                            </div>
                            </div>

                            {{-- <div class="circle3">
                                <a href="#" class="btn btn-fab" title="Editar" data-bs-toggle="modal" data-bs-target="#formularioEditReserva" data-idreserva="{{ $idReserva }}">
                                    <i class="fas fa-edit" style="color: white;"></i>  
                                </a>
                                @include('reservas.editar')
                            </div> --}}

                            <div class="circle5">
                                <a href="#" class="btn btn-fab" title="Eliminar" id="eliminar2"> 
                                <i class="bi bi-trash3-fill" style="color: white;"></i>
                                <input type="hidden" id="idReserva" value="{{ $idReserva }}">
                                </a>						
                            </div>
                        </div>
                    </th>
                </tr>	
            </thead>
    
            @endif
      
        @endif
           
       @endfor
    </table>
        @if (session('success'))
            <script>
                Swal.fire({
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            </script>
        @endif
</div>
<script>
    function obtenerIdReserva() {
    // Obtener el valor del campo de entrada oculto
    var idReserva = document.getElementById('idReserva').value;
    return idReserva;
}
</script>
<script>
    // Agrega un evento de clic al botón de eliminar
    document.getElementById('eliminar1').addEventListener('click', function(event) {
        event.preventDefault(); // Previene la acción por defecto del botón

        Swal.fire({
            title: '¿Estás seguro de eliminar la solicitud de reserva?',
            text: 'No podrás revertir este cambio',
            icon: 'warning',
            iconColor: 'red', // Color del icono
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: 'green', // Color del botón "Aceptar"
            cancelButtonColor: 'red' // Color del botón "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Obtener el valor de idReserva desde algún lugar de tu página
                var idReserva = obtenerIdReserva(); // Implementa esta función para obtener el idReserva que deseas enviar

                // Redirigir a la URL con el idReserva como parte de la ruta
                window.location.href = '/reservas/pendientesDocente/'+ idReserva;
                
            }
        });
    });
</script>

<script>
    // Agrega un evento de clic al botón de eliminar
    document.getElementById('eliminar2').addEventListener('click', function(event) {
        event.preventDefault(); // Previene la acción por defecto del botón

        Swal.fire({
            title: '¿Estás seguro de eliminar la solicitud de reserva?',
            text: 'No podrás revertir este cambio',
            icon: 'warning',
            iconColor: 'red', // Color del icono
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: 'green', // Color del botón "Aceptar"
            cancelButtonColor: 'red' // Color del botón "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Obtener el valor de idReserva desde algún lugar de tu página
                var idReserva = obtenerIdReserva(); // Implementa esta función para obtener el idReserva que deseas enviar

                // Redirigir a la URL con el idReserva como parte de la ruta
                window.location.href = '/reservas/pendientesDocente/'+ idReserva;
                
            }
        });
    });
</script>

@endsection
