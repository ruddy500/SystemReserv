@extends('index')

@section('notificaciones/lista')
<?php
use App\Models\UsuariosNotificacion;
use App\Models\Notificaciones;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente

$notificaciones = Notificaciones::all();

?>
<div class="container mt-3">
	<div class="card">
		<h3 class="card-header">Historial de notificaciones</h3>
		<div class="card-body">
            <div class="list-group">

                @foreach ( $notificaciones as $notificacion)
                    <?php
                       
                        $fecha = Carbon::parse($notificacion->fechaEnvio)->locale('es');
                        // Formatear la fecha de envío
                        $fechaEnvioFormateada = $fecha->isoFormat('D [de] MMMM');
                        // dd($fecha,$fechaEnvioFormateada);
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
                                    <a href="{{ route('notificaciones.asignacion',['reservaId' => $idReserva,'notificacionId' => $idNotificacion]) }}" class="list-group-item list-group-item-action" aria-current="true" onclick="openNotification(this)">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 notif">Asignación de solicitud de reserva</h5>
                                            <div class="position-relative">
                                                <small class="text-body-secondary">{{ $fechaEnvioFormateada }}</small>
                                                <span class="notification-dot" id="estado"></span>
                                            </div>
                                        </div>
                                        <p class="mb-1">adaEnterprissoft@gmail.com</p>
                                    </a>
                                
                                    @break
                                @case('sugerencia')
                                    <!-- NOTIFICACION DE SUGERENCIA -->
                                    <a href="{{ route('notificaciones.sugerencia',['reservaId' => $idReserva,'notificacionId' => $idNotificacion]) }}" class="list-group-item list-group-item-action" onclick="openNotification(this)">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 notif">Sugerencia de solicitud de reserva</h5>
                                            <div class="position-relative">
                                                <small class="text-body-secondary">{{ $fechaEnvioFormateada }}</small>
                                                <span class="notification-dot"></span>
                                            </div>
                                        </div>
                                        <p class="mb-1">adaEnterprissoft@gmail.com</p>
                                    </a>
                                    
                                    @break
                                @case('rechazado')
                                    <!-- NOTIFICACION DE RECHAZO -->
                                    <a href="{{ route('notificaciones.rechazo',['reservaId' => $idReserva,'notificacionId' => $idNotificacion]) }}" class="list-group-item list-group-item-action" onclick="openNotification(this)">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 notif">Rechazo de solicitud de reserva</h5>
                                            <div class="position-relative">
                                                <small class="text-body-secondary">{{ $fechaEnvioFormateada  }}</small>
                                                <span class="notification-dot"></span>
                                            </div>
                                        </div>
                                        <p class="mb-1">adaEnterprissoft@gmail.com</p>
                                    </a>
                                
                                    @break
                            
                                @default
                                    <!-- NOTIFICACION MENSAJE MASIVO -->
                                    <a href="{{ route('notificaciones.difusion',['notificacionId' => $idNotificacion]) }}" class="list-group-item list-group-item-action list-group-item-info" onclick="openNotification(this)">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 notif">Inicio de recepción solicitudes reservas</h5>
                                            <div class="position-relative">
                                                <small class="text-body-secondary">{{ $fechaEnvioFormateada }}</small>
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
// document.addEventListener('DOMContentLoaded', function() {
//     updateNotificationCount();
//     document.querySelectorAll('.list-group-item').forEach(function(item) {
//         item.addEventListener('click', function() {
//             openNotification(item);
//             updateNotificationCount();
//         });
//     });
// });

// function updateNotificationCount() {
//     var notificationDots = document.querySelectorAll('.notification-dot');
//     var visibleDotsCount = 0;

//     notificationDots.forEach(function(dot) {
//         if (window.getComputedStyle(dot).display !== 'none') {
//             visibleDotsCount++;
//         }
//     });

//     console.log("Visible Dots Count: ", visibleDotsCount); // Depuración

//     var notificationsIcon = document.getElementById('notificaciones-icon');
//     if (notificationsIcon) {
//         var notificationCountSpan = notificationsIcon.querySelector('.notification-count');
//         if (notificationCountSpan) {
//             if (visibleDotsCount > 0) {
//                 notificationCountSpan.textContent = visibleDotsCount;
//                 notificationCountSpan.style.display = 'flex'; // Mostrar el círculo rojo
//             } else {
//                 notificationCountSpan.style.display = 'none'; // Ocultar el círculo rojo
//             }
//             console.log("Notification Count Updated: ", visibleDotsCount); // Depuración
//         }
//     }
// }

// function openNotification(element) {
//     var estado = element.querySelector('.notification-dot');
//     if (estado) {
//         estado.style.display = 'none';
//     }
// }
</script>
@endsection