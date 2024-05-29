@extends('index')

@section('notificaciones/admin/lista')
<div class="container mt-3">
	<div class="card">
		<h3 class="card-header">Historial de notificaciones</h3>
		<div class="card-body">
            <div class="list-group">
                <!-- NOTIFICACION DE ACEPTACION DE SUGERENCIA -->
                <a href="{{ route('notificaciones.admin.sugerencia') }}" class="list-group-item list-group-item-action" aria-current="true" onclick="openNotification(this)">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 notif">Sugerencia de solicitud de reserva aceptada</h5>
                        <div class="position-relative">
                            <small class="text-body-secondary">25 de Mayo</small>
                            <span class="notification-dot"></span>
                        </div>
                    </div>
                    <p class="mb-1">leticia@gmail.com</p>
                </a>
                <!-- NOTIFICACION DE RECHAZO DE SUGERENCIA -->
                <a href="{{ route('notificaciones.admin.sugerencia') }}" class="list-group-item list-group-item-action" onclick="openNotification(this)">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 notif">Sugerencia de solicitud de reserva rechazada</h5>
                        <div class="position-relative">
                            <small class="text-body-secondary">21 de Mayo</small>
                            <span class="notification-dot"></span>
                        </div>
                    </div>
                    <p class="mb-1">carmenRoza02@gmail.com</p>
                </a>
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