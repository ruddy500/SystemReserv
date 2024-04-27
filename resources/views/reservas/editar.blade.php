@extends('index')

@section('reservas/editar')
<div class="container mt-3">
	<div class="card vercard">
		<h3 class="card-header">Editar reserva</h3>
        <div class="card-body bg-content">
            <div class="row">
                <form id="reservasForm" method="POST">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <!-- Seleccionable de fecha -->
                                <label for="fecha-name" class="col-form-label h4">Fecha:</label>
                                <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                    <input name="fecha" id="fechaInput" class="form-control" type="text" readonly />               
                                    <span class="input-group-addon"></span>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                    <!-- campo para mostrar la lista horarios en orden desde la base de datos-->
                    <label for="periodo-name" class="col-form-label h4">Periodo:</label>
                    <div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="bg-custom-lista">
                                <tr>
                                    <th class="text-center h4 text-white">Hora inicio</th>
                                    <th class="text-center h4 text-white">Hora fin</th>
                                    <th class="text-center h4 text-white">Selección</th>
                                </tr>
                            </thead>
                            <!-- Fila Ploma -->
                            <thead class="bg-custom-lista-fila-plomo">	
                                <tr>
                                    <th class="text-center h4 text-black">06:45</th>
                                    <th class="text-center h4 text-black">08:15</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input class="form-check-input horario" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <!-- Fila blanca -->
                            <thead class="bg-custom-lista-fila-blanco">
                                <tr>
                                    <th class="text-center h4 text-black">08:15</th>
                                    <th class="text-center h4 text-black">09:45</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input class="form-check-input horario" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                            </div>
                                        </div>
                                    </th>
                                </tr>	
                            </thead>
                            <!-- Fila Ploma -->
                            <thead class="bg-custom-lista-fila-plomo">	
                                <tr>
                                    <th class="text-center h4 text-black">09:45</th>
                                    <th class="text-center h4 text-black">11:15</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input class="form-check-input horario" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <!-- Fila blanca -->
                            <thead class="bg-custom-lista-fila-blanco">
                                <tr>
                                    <th class="text-center h4 text-black">08:15</th>
                                    <th class="text-center h4 text-black">09:45</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input class="form-check-input horario" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                            </div>
                                        </div>
                                    </th>
                                </tr>	
                            </thead>
                            <!-- Fila Ploma -->
                            <thead class="bg-custom-lista-fila-plomo">	
                                <tr>
                                    <th class="text-center h4 text-black">09:45</th>
                                    <th class="text-center h4 text-black">11:15</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input class="form-check-input horario" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- BOTONES ACEPTAR Y CANCELAR -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-aceptar">Aceptar</button>
                        <button id="cancelar" type="button" class="btn btn-cancelar">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Supongamos que tus checkboxes tienen la clase 'horario'
    let checkboxes = document.querySelectorAll('.horario');

    // Limitar a 2 la selección de checkboxes y deshabilitar los demás cuando se seleccionan 2
    checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', function() {
            let checked = document.querySelectorAll('.horario:checked');
            if (checked.length >= 2) {
                checkboxes.forEach((c) => {
                    if (!c.checked) {
                        c.disabled = true;
                    }
                });
            } else {
                checkboxes.forEach((c) => {
                    c.disabled = false;
                });
            }
        });
    });

    // Verificar si los horarios seleccionados son contiguos al enviar el formulario
    document.getElementById('reservasForm').addEventListener('submit', function(event) {
        let checked = document.querySelectorAll('.horario:checked');
        if (checked.length === 0) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Seleccione por lo menos un horario.',
                confirmButtonText: 'Aceptar',
            });
        } else if (checked.length === 2) {
            let first = Array.from(checkboxes).indexOf(checked[0]);
            let second = Array.from(checkboxes).indexOf(checked[1]);
            if (Math.abs(first - second) !== 1) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Error...',
                    text: 'Escoge dos horarios contiguos.',
                    confirmButtonText: 'Aceptar',
                });
            } else {
                event.preventDefault(); // Evita el envío automático del formulario
                // Mostrar el modal de éxito
                Swal.fire({
                    icon: 'success',
                    text: 'Reserva Actualizada exitosamente.',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar el formulario solo si se hace clic en "Aceptar"
                        document.getElementById('reservasForm').submit();
                    }
                });
            }
        } else if (checked.length === 1) {
            event.preventDefault(); // Evita el envío automático del formulario
            // Mostrar el modal de éxito
            Swal.fire({
                icon: 'success',
                text: 'Reserva Actualizada exitosamente.',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario solo si se hace clic en "Aceptar"
                    document.getElementById('reservasForm').submit();
                }
            });
        }
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Evento click para el botón "Cancelar"
        document.getElementById('cancelar').addEventListener('click', function() {
            // Mostrar mensaje de confirmación
            Swal.fire({
                icon: 'info',
                title: 'Cancelado',
                text: 'Has cancelado editar tu Reserva.',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirige a la otra página aquí
                    window.location.href = "/reservas";
                }
            });
        });
    });
</script>

@endsection
