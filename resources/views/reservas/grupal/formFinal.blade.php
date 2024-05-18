@extends('reservas/principal')

<?php 
use App\Models\Materias;

$totalEstudiantes = 0;
        // aqui se va añadir materias seleccionado a la base de datos
        for ($i = 0; $i < count($materias); $i++) {
            $valor = $materias[$i];
            $materia = Materias::where('id', $valor)->first();
            $totalEstudiantes = $totalEstudiantes + $materia->Inscritos;

        }
// dd($totalEstudiantes);


?>
 
{{-- @foreach($materias as $materia)
    {{ dd($materia) }}
@endforeach --}}

@section('contenido-registrarGrupal')
{{-- {{ dd(get_defined_vars()) }}  --}}
<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="row">
            <p class="h3" style="text-align: center;">Formulario de reserva grupal - Parte 2</p>
            <!-- FORMULARIO -->
            <form id="" action="{{route('reservas.guardarGrupal')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                {{-- campo para enviar el usuario --}}
                <input type="hidden" name="usuario" value="{{auth()->user()->id}}">
                {{-- campo para enviar materias --}}
                <input type="hidden" name="materias" value="{{json_encode($materias)}}">
                <!-- Campo para poner la cantidad de estudiantes totales -->
                <div class="col">
                    <label for="totalEstudiantes-name" class="col-form-label h4">Total estudiantes: {{$totalEstudiantes}}</label>
                </div>
                <div class="col">
                    <!-- Campo de cantidad de estudiantes y motivo en la misma fila -->
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="cantidad-name" class="col-form-label h4">Cantidad de estudiantes:</label>
                                <input type="number" name="cantidad" class="form-control" id="cantidad-name" minlength="3" maxlength="100" min="10" max="{{$totalEstudiantes}}" required>
                                <div class="invalid-feedback">
                                    La cantidad de estudiantes debe estar entre 10 y {{$totalEstudiantes}}.
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="motivo-name" class="col-form-label h4">Motivo:</label>
                                <select name="motivo" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                    <!-- Captura el Motivo -->
                                    @foreach ($motivos as $motivo)
                                    <option value= "{{ $motivo->id }}"> {{ $motivo->Nombre }} </option>
                                    @endforeach
                                </select> 
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
                                <input name="fecha" id="fechaInput" class="form-control" type="text" readonly />               
                                <span class="input-group-addon"></span>
                            </div>
                        </div>
                        <div class="col">
                            <!-- CAMPO TIPO DE AMBIENTE AÑADIDO -->
                            <div class="mb-3">
                                <label for="tipo-ambiente-name" class="col-form-label h4">Tipo de ambiente:</label>
                               
                                <?php
                                use App\Models\TipoAmbientes;
                                 $tipo = TipoAmbientes ::all();
                                 $tam = $tipo->count();
                                ?>
                                <select name="tipoAmbiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                   
                                <option value="" disabled selected >Seleccione tipo de ambiente</option>
                                    @for($i=0;$i<$tam;$i++) 
                                    <option name="tipoAmbiente[]" value="{{$tipo[$i]->id}}" >{{ $tipo[$i]->Nombre }}</option>
                                    @endfor
                                </select>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- campo para mostrar la lista horarios en orden  desde la base de datos-->
                    <label for="periodo-name" class="col-form-label h4">Periodo:</label>
                    <div id="tabla" class="table-responsive margin" style="max-height: 250px; overflow-y: auto;">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="bg-custom-lista">
                                <tr>
                                    <th class="text-center h4 text-white">Hora inicio</th>
                                    <th class="text-center h4 text-white">Hora fin</th>
                                    <th class="text-center h4 text-white">Selección</th>
                                </tr>
                            </thead>
                            {{-- <form id="reservasForm" action="" method="post"> --}}
                                @foreach ($periodosGrupal as $periodo)
                                @php
                                    // Dividir la cadena de hora en hora de inicio y hora de fin
                                    $horas = explode('-', $periodo->HoraIntervalo);
                                    $horaIni = trim($horas[0]); // Hora de inicio
                                    $horaFin = trim($horas[1]); // Hora de fin
                                @endphp

                                @if ($periodo->id % 2 != 0)
                                    <tr class="bg-custom-lista-fila-plomo">
                                @else
                                    <tr class="bg-custom-lista-fila-blanco">
                                @endif
                                    <td class="text-center h4 text-black">{{ $horaIni }}</td>
                                    <td class="text-center h4 text-black">{{ $horaFin }}</td>
                                    <td class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                {{-- aqui se envia la opcion que se elije --}}
                                                <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="{{$periodo->id}}" aria-label="..." 
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- </form> --}}
                        </table>
                    </div>
                </div>
                <!-- BOTONES ACEPTAR Y CANCELAR -->
                <div class="modal-footer">
                    <button id="btn-aceptar" type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button id="cancelar" type="button" class="btn btn-cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script>
    // Validación de los campos de capacidad de estudiantes, motivo y fecha
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
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var maxCheckboxes = 2;

        checkboxes.forEach(function(checkbox, index) {
            checkbox.addEventListener('change', function() {
                var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
                
                if (checkedCheckboxes.length >= maxCheckboxes) {
                    checkboxes.forEach(function(cb) {
                        if (!cb.checked) {
                            cb.disabled = true;
                        }
                    });
                } else {
                    checkboxes.forEach(function(cb) {
                        cb.disabled = false;
                    });
                }
            });
        });

        var form = document.querySelector('.needs-validation');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            var cantidad = document.querySelector('input[name="cantidad"]');
            var motivo = document.querySelector('select[name="motivo"]');
            var tipoAmbiente = document.querySelector('select[name="tipoAmbiente"]');

            if (checkedCheckboxes.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Error..',
                    text: 'Seleccione al menos un horario',
                    confirmButtonText: 'Aceptar',
                });
            } else if (checkedCheckboxes.length === maxCheckboxes) {
                var checkedIndexes = Array.from(checkboxes).map(function(cb, i) {
                    return cb.checked ? i : -1;
                }).filter(function(index) {
                    return index !== -1;
                });

                if (Math.abs(checkedIndexes[1] - checkedIndexes[0]) !== 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error...',
                        text: 'Por favor seleccione horarios contiguos.',
                        confirmButtonText: 'Aceptar',
                    });
                } else if (cantidad.value === "" || motivo.value === "" || tipoAmbiente.value === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error...',
                        text: 'Por favor completa todos los campos.',
                        confirmButtonText: 'Aceptar',
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Reserva registrada exitosamente.',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            } else if (checkedCheckboxes.length === 1) {
                if (cantidad.value === "" || motivo.value === "" || tipoAmbiente.value === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error...',
                        text: 'Por favor completa todos los campos.',
                        confirmButtonText: 'Aceptar',
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Reserva registrada exitosamente.',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            }
        });

        // Aquí es donde agregas el controlador de eventos al botón "Cancelar"
        var cancelar = document.querySelector('#cancelar');
        cancelar.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Reserva cancelada',
                text: 'Has cancelado la reserva.',
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('.needs-validation');
        var btnAceptar = document.getElementById('btn-aceptar');
        var cantidadInput = document.querySelector('input[name="cantidad"]');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });

        cantidadInput.addEventListener('input', function() {
            if (cantidadInput.checkValidity()) {
                btnAceptar.disabled = false;
            } else {
                btnAceptar.disabled = true;
            }
        });
    });
</script>
