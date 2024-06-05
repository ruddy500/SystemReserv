@extends('index')
<?php

use App\Models\UsuariosNotificacion;
use App\Models\Usuarios;
use App\Models\Reservas;
use App\Models\Notificaciones;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente

$notificaciones = Notificaciones::all();

// dd($idsLeidos);
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
                    // $fueSugerido = $Reserva->Fuesugerido; 
                    $fueSugerido = $Reserva ? $Reserva->Fuesugerido : null;
                    // $EstadoReserva=$Reserva->Estado;
                    $EstadoReserva = $Reserva ? $Reserva->Estado : null;
                ?>

@if($notificacion->Tipo === 'sugerencia' && $fueSugerido==='si' && $EstadoReserva==='rechazado')
            <!-- NOTIFICACION DE RECHAZO -->
            

            <!-- NOTIFICACION DE RECHAZO DE SUGERENCIA -->
            <a href="{{ route('notificaciones.admin.sugerenciaRechazo',['reservaId' => $idReserva,'notificacionId' => $idNotificacion]) }}" class="list-group-item list-group-item-action" onclick="openNotification(this)">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 notif">Sugerencia de solicitud de reserva rechazada</h5>
                    <div class="position-relative">
                        <small class="text-body-secondary">{{ $fechaEnvioFormateada  }}</small>    
                        {{-- <span display='none' class="notification-dot"></span> --}}
                        <?php 
                        $idPresente = in_array($idReserva, $idsLeidos);
                        ?>
                        @if ($idPresente == false)
                            <span class="notification-dot"></span>
    
                        @else
                            {{-- <span display='none' class="notification-dot"></span> --}}
                        @endif
                    </div>
                </div>
                <p class="mb-1">{{$correo}}</p>
            </a>

@elseif($notificacion->Tipo === 'sugerencia' && $fueSugerido==='si' && $EstadoReserva==='asignado')
            <!-- CONTENIDO PARA OTRO TIPO DE RESERVA -->
            <a href="{{ route('notificaciones.admin.sugerenciaAsignacion',['reservaId' => $idReserva,'notificacionId' => $idNotificacion]) }}" class="list-group-item list-group-item-action" aria-current="true" onclick="openNotification(this)">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 notif">Sugerencia de solicitud de reserva aceptada</h5>
                    <div class="position-relative">
                        <small class="text-body-secondary">{{ $fechaEnvioFormateada  }}</small>
                        {{-- <span class="notification-dot"></span> --}}
                        <?php 
                        $idPresente = in_array($idReserva, $idsLeidos);
                        ?>
                        @if ($idPresente == false)
                            <span class="notification-dot"></span>
    
                        @else
                            {{-- <span display='none' class="notification-dot"></span> --}}
                        @endif
                        
                    </div>
                </div>
                <p class="mb-1">{{$correo}}</p>
            </a> 
    
@endif


                @endforeach

                
            </div>
        </div>
    </div>
</div>
<script>

</script>
@endsection