@extends('index')

@section('notificaciones/lista')
<?php
use App\Models\UsuariosNotificacion;
use App\Models\Notificaciones;

$notificaciones = Notificaciones::all();

?>
<div class="container mt-3">
	<div class="card">
		<h3 class="card-header">Historial de notificaciones</h3>
		<div class="card-body">
            <div class="list-group">

                @foreach ( $notificaciones as $notificacion)
                    <?php
                        $fecha = $notificacion->fecha_actual_sistema;
                        $tipoReserva = $notificacion->Tipo;
                        $idReserva = $notificacion->reservas_id;
                        $idNotificacion = $notificacion->id;

                        $registroUN = UsuariosNotificacion::where('notificaciones_id',$idNotificacion)->first();
                        $idDocente = $registroUN->usuarios_id;

                    ?>
                   @if ($idDocente == auth()->user()->id)
                        @switch($tipoReserva)
                        
                                @case('asignacion')
                                    <!-- NOTIFICACION DE ASIGNACION -->
                                    <a href="{{ route('notificaciones.asignacion',['reservaId' => $idReserva]) }}" class="list-group-item list-group-item-action" aria-current="true" onclick="openNotification(this)">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 notif">Asignación de solicitud de reserva</h5>
                                            <div class="position-relative">
                                                <small class="text-body-secondary">{{ $fecha }}</small>
                                                <span class="notification-dot" id="estado"></span>
                                            </div>
                                        </div>
                                        <p class="mb-1">adaEnterprissoft@gmail.com</p>
                                    </a>
                                
                                    @break
                                @case('sugerencia')
                                    <!-- NOTIFICACION DE SUGERENCIA -->
                                    <a href="{{ route('notificaciones.sugerencia',['reservaId' => $idReserva]) }}" class="list-group-item list-group-item-action" onclick="openNotification(this)">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 notif">Sugerencia de solicitud de reserva</h5>
                                            <div class="position-relative">
                                                <small class="text-body-secondary">{{ $fecha }}</small>
                                                <span class="notification-dot"></span>
                                            </div>
                                        </div>
                                        <p class="mb-1">adaEnterprissoft@gmail.com</p>
                                    </a>
                                    
                                    @break
                                @case('rechazado')
                                    <!-- NOTIFICACION DE RECHAZO -->
                                    <a href="{{ route('notificaciones.rechazo',['reservaId' => $idReserva]) }}" class="list-group-item list-group-item-action" onclick="openNotification(this)">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 notif">Rechazo de solicitud de reserva</h5>
                                            <div class="position-relative">
                                                <small class="text-body-secondary">{{ $fecha }}</small>
                                                <span class="notification-dot"></span>
                                            </div>
                                        </div>
                                        <p class="mb-1">adaEnterprissoft@gmail.com</p>
                                    </a>
                                
                                    @break
                            
                                @default
                                    <!-- NOTIFICACION MENSAJE MASIVO -->
                                    <a href="{{ route('notificaciones.difusion') }}" class="list-group-item list-group-item-action list-group-item-info" onclick="openNotification(this)">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 notif">Inicio de recepción solicitudes reservas</h5>
                                            <div class="position-relative">
                                                <small class="text-body-secondary">{{ $fecha }}</small>
                                                <span class="notification-dot"></span>
                                            </div>
                                        </div>
                                        <p class="mb-1">adaEnterprissoft@gmail.com</p>
                                    </a>
                        @endswitch
                   @endif

                @endforeach
               
               
               
               
            </div>
        </div>
    </div>
</div>
<script>
    function openNotification(element) {
    // Hacer desaparecer el círculo azul
    var estado = element.querySelector('.notification-dot');
    if (estado) {
        estado.style.display = 'none'; // hace que el circulo de color azul no se muestre
        alert("Notificación abierta"); // si se abre la notificacion se  muestra esta alerta 
                                       // hayque darle en ecepatar y luego volver atras para ver que esta funcionado
    }
}
</script>
@endsection