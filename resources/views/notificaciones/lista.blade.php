@extends('index')

@section('notificaciones/lista')
<div class="container mt-3">
	<div class="card">
		<h3 class="card-header">Historial de notificaciones</h3>
		<div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 notif">Asignación de solicitud de reserva</h5>
                    <small class="text-body-secondary">25 de Mayo</small>
                    </div>
                    <p class="mb-1">adaEnterprissoft@gmail.com</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 notif">Rechazo de solicitud de reserva</h5>
                    <small class="text-body-secondary">20 de Mayo</small>
                    </div>
                    <p class="mb-1">adaEnterprissoft@gmail.com</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 notif">Sugerencia de solicitud de reserva</h5>
                    <small class="text-body-secondary">20 de Mayo</small>
                    </div>
                    <p class="mb-1">adaEnterprissoft@gmail.com</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection