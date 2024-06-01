@extends('index')
<?php

use App\Models\UsuariosNotificacion;
use App\Models\Usuarios;
use App\Models\Reservas;
use App\Models\Notificaciones;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente

$notificaciones = Notificaciones::all();

?>
@section('notificaciones/admin/lista')
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
                    // dd($tipoReserva);
                    $idReserva = $notificacion->reservas_id;
                    // dd($idReserva);
                    $idNotificacion = $notificacion->id;
                    // dd($idNotificacion);
                    $registroUN = UsuariosNotificacion::where('notificaciones_id',$idNotificacion)->first();
                    $idDocente = $registroUN->usuarios_id;
                    
                    $Usuario = Usuarios::where('id',$idDocente)->first();
                    // dd($Usuario);
                    $correo= $Usuario->email;

                    $Reserva = Reservas::where('id',$idReserva)->first();
                    $fueSugerido = $Reserva->Fuesugerido; 
                    $EstadoReserva=$Reserva->Estado;
                ?>

@if($notificacion->Tipo === 'sugerencia' && $fueSugerido==='si' && $EstadoReserva==='rechazado')
            <!-- NOTIFICACION DE RECHAZO -->
            

            <!-- NOTIFICACION DE RECHAZO DE SUGERENCIA -->
            <a href="{{ route('notificaciones.admin.sugerencia',['reservaId' => $idReserva,'notificacionId' => $idNotificacion]) }}" class="list-group-item list-group-item-action" onclick="openNotification(this)">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 notif">Sugerencia de solicitud de reserva rechazada</h5>
                    <div class="position-relative">
                        <small class="text-body-secondary">{{ $fechaEnvioFormateada  }}</small>
                        <span class="notification-dot"></span>
                    </div>
                </div>
                <p class="mb-1">{{$correo}}</p>
            </a>

@elseif($notificacion->Tipo === 'sugerencia' && $fueSugerido==='si' && $EstadoReserva==='asignado')
            <!-- CONTENIDO PARA OTRO TIPO DE RESERVA -->
            <a href="{{ route('notificaciones.admin.sugerencia') }}" class="list-group-item list-group-item-action" aria-current="true" onclick="openNotification(this)">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 notif">Sugerencia de solicitud de reserva aceptada</h5>
                    <div class="position-relative">
                        <small class="text-body-secondary">{{ $fechaEnvioFormateada  }}</small>
                        <span class="notification-dot"></span>
                    </div>
                </div>
                <p class="mb-1">{{$correo}}</p>
            </a> 
    
@endif


                @endforeach

                <!-- NOTIFICACION DE ACEPTACION DE SUGERENCIA -->
                {{-- <a href="{{ route('notificaciones.admin.sugerencia') }}" class="list-group-item list-group-item-action" aria-current="true" onclick="openNotification(this)">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 notif">Sugerencia de solicitud de reserva aceptada</h5>
                        <div class="position-relative">
                            <small class="text-body-secondary">25 de Mayo</small>
                            <span class="notification-dot"></span>
                        </div>
                    </div>
                    <p class="mb-1">leticia@gmail.com</p>
                </a> --}}
                {{-- <!-- NOTIFICACION DE RECHAZO DE SUGERENCIA -->
                <a href="{{ route('notificaciones.admin.sugerencia') }}" class="list-group-item list-group-item-action" onclick="openNotification(this)">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 notif">Sugerencia de solicitud de reserva rechazada</h5>
                        <div class="position-relative">
                            <small class="text-body-secondary">21 de Mayo</small>
                            <span class="notification-dot"></span>
                        </div>
                    </div>
                    <p class="mb-1">carmenRoza02@gmail.com</p>
                </a> --}}
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