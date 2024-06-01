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
                            <span class="notification-dot" id="estado"></span>
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
document.addEventListener('DOMContentLoaded', function() {
    updateNotificationCount();
    document.querySelectorAll('.list-group-item').forEach(function(item) {
        item.addEventListener('click', function() {
            openNotification(item);
            updateNotificationCount();
        });
    });
});

function updateNotificationCount() {
    var notificationDots = document.querySelectorAll('.notification-dot');
    var visibleDotsCount = 0;

    notificationDots.forEach(function(dot) {
        if (window.getComputedStyle(dot).display !== 'none') {
            visibleDotsCount++;
        }
    });

    console.log("Visible Dots Count: ", visibleDotsCount); // Depuración

    var notificationsIcon = document.getElementById('notificaciones-icon');
    if (notificationsIcon) {
        var notificationCountSpan = notificationsIcon.querySelector('.notification-count');
        if (notificationCountSpan) {
            if (visibleDotsCount > 0) {
                notificationCountSpan.textContent = visibleDotsCount;
                notificationCountSpan.style.display = 'flex'; // Mostrar el círculo rojo
            } else {
                notificationCountSpan.style.display = 'none'; // Ocultar el círculo rojo
            }
            console.log("Notification Count Updated: ", visibleDotsCount); // Depuración
        }
    }
}

function openNotification(element) {
    var estado = element.querySelector('.notification-dot');
    if (estado) {
        estado.style.display = 'none';
    }
}
</script>
@endsection