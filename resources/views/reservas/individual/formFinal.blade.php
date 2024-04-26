@extends('reservas/principal')

@section('contenido-registrarIndividual')
<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="row">
            <!-- FORMULARIO -->
            <form id="" method="POST" class="needs-validation" novalidate>
                <!-- Campo para poner la cantidad de estudiantes totales -->
                <div class="col">
                    <label for="totalEstudiantes-name" class="col-form-label h4">Total estudiantes: 190</label>
                </div>
                <div class="col">
                    <!-- Campo de cantidad de estudiantes y motivo en la misma fila -->
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="cantidad-name" class="col-form-label h4">Cantidad de estudiantes:</label>
                                <input type="number" name="cantidad" class="form-control" id="cantidad-name" minlength="3" maxlength="100" min="10" max="300" required>
                                <div class="invalid-feedback">
                                    Por favor ingresa la cantidad de estudiantes.
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="motivo-name" class="col-form-label h4">Motivo:</label>
                                <select name="motivo" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                    <option value="" disabled selected>Seleccione motivo</option>
                                    <option>Examen primer parcial</option>
                                    <option>Examen segundo parcial</option> 
                                    <option>Examen final</option> 
                                    <option>Examen segunda instancia</option> 
                                    <option>Examen de mesa</option> 
                                    <option>Taller</option> 
                                    <option>Seminario</option>      
                                </select> 
                                <div class="invalid-feedback">
                                    Por favor selecciona un motivo.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <!-- Seleccionable de fecha -->
                            <label for="fecha-name" class="col-form-label h4">Fecha:</label>
                            <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                <input name="fecha" id="fechaInput" class="form-control" type="text" readonly required />               
                                <span class="input-group-addon"></span>
                                <div class="invalid-feedback">
                                    Por favor selecciona una fecha.
                                </div>
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
                            <form id="reservasForm" action="" method="post">
                                <!-- Fila Ploma -->
                                <thead class="bg-custom-lista-fila-plomo">	
                                    <tr>
                                        <th class="text-center h4 text-black">06:45</th>
                                        <th class="text-center h4 text-black">08:15</th>
                                        <th class="text-center h4 text-black">
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="..." >
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
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="..." >
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
                                                    <input class="form-check-input checkbox-validate" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="..." >
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
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="..." >
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
                                                    <input class="form-check-input checkbox-validate" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="..." >
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </form>
                        </table>
                    </div>
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
@endsection
<script>
    // esto es para validar los campos de capacidad de estudiantes, motivo y fecha
(function () {
  'use strict'
  window.addEventListener('load', function () {
    var forms = document.getElementsByClassName('needs-validation')
    Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  }, false)
})()
</script>

<script>
    //aqui validamos todos lo que tiene que ver con los horarios
document.addEventListener('DOMContentLoaded', function () {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var maxCheckboxes = 2;

    // Event listener para los cambios en los checkboxes
    checkboxes.forEach(function(checkbox, index) {
        checkbox.addEventListener('change', function() {
            // Obtener los checkboxes seleccionados
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            
            // Si se seleccionan más de dos checkboxes, deshabilitar los restantes
            if (checkedCheckboxes.length >= maxCheckboxes) {
                checkboxes.forEach(function(cb) {
                    if (!cb.checked) {
                        cb.disabled = true;
                    }
                });
            } else {
                // Habilitar todos los checkboxes si no se ha alcanzado el límite
                checkboxes.forEach(function(cb) {
                    cb.disabled = false;
                });
            }

            // Verificar si se han seleccionado exactamente 2 checkboxes
            if (checkedCheckboxes.length === maxCheckboxes) {
                // Obtener los índices de los checkboxes seleccionados
                var checkedIndexes = Array.from(checkboxes).map(function(cb, i) {
                    return cb.checked ? i : -1;
                }).filter(function(index) {
                    return index !== -1;
                });

                // Verificar si los índices seleccionados no son contiguos
                if (Math.abs(checkedIndexes[1] - checkedIndexes[0]) !== 1) {
                    // Mostrar SweetAlert si los horarios no son contiguos
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error...',
                        text: 'Por favor seleccione horarios contiguos.',
                        confirmButtonText: 'Aceptar',
                    });
                }
            }
        });
    });
//antes de enviar el formulario verificamos si esta vacio o no son contiguos
    var form = document.querySelector('.needs-validation');
    // Event listener para el envío del formulario
    form.addEventListener('submit', function(event) {
        var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        // Verificar si no se ha seleccionado ningún horario
        if (checkedCheckboxes.length === 0) {
            event.preventDefault();
            // Mostrar SweetAlert si no se ha seleccionado ningún horario
            Swal.fire({
                icon: 'warning',
                title: 'Error..',
                text: 'Seleccione al menos un horario',
                confirmButtonText: 'Aceptar',
            });
        } else if (checkedCheckboxes.length === maxCheckboxes) {
            // Verificar si los horarios seleccionados son contiguos
            var checkedIndexes = Array.from(checkboxes).map(function(cb, i) {
                return cb.checked ? i : -1;
            }).filter(function(index) {
                return index !== -1;
            });

            if (Math.abs(checkedIndexes[1] - checkedIndexes[0]) !== 1) {
                // Mostrar SweetAlert si los horarios no son contiguos
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Error...',
                    text: 'Por favor seleccione horarios contiguos.',
                    confirmButtonText: 'Aceptar',
                });
            }
        }
    });
});
</script>
