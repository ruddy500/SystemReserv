@extends('index')

@section('reservas/editar')
<div class="container mt-3">
    <div class="card vercard">
        <h3 class="card-header">Editar reserva</h3>
        <div class="card-body bg-content">
            <div class="row">
                <form id="reservasForm" action="{{ route('reserva.actualizar',['idReserva'=>$idReserva])}}" method="POST">
                    @csrf
                    @method('PUT')
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

                            @foreach ($periodos as $periodo)
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
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="{{$periodo->id}}" aria-label="..." >
                                           
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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

var form = document.querySelector('#reservasForm'); // Selector cambiado para coincidir con el ID del formulario
form.addEventListener('submit', function(event) {
    event.preventDefault();
    var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

    if (checkedCheckboxes.length === 0) {
        //console.log("No se ha seleccionado ningún horario.");
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'Seleccione al menos un horario',
            confirmButtonText: 'Aceptar',
        });
    } else if (checkedCheckboxes.length === 1 || checkedCheckboxes.length === 2) {
        var checkedIds = Array.from(checkedCheckboxes).map(function(checkbox) {
            return parseInt(checkbox.value);
        }).sort(function(a, b) {
            return a - b; // Comparación numérica ascendente
        });
        //console.log("IDs de checkboxes seleccionados: ", checkedIds);

        // Verificar si los IDs de los checkboxes seleccionados son contiguos
        var contiguos = true;
        for (var i = 0; i < checkedIds.length - 1; i++) {
            if (checkedIds[i] + 1 !== checkedIds[i + 1]) {
                contiguos = false;
                //console.log("Los horarios no son contiguos.");
                break;
            }
        }

        if (contiguos) {
            //console.log("Los horarios son contiguos.");
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Se realizaron las modificaciones exitosamente.',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                   // window.location.href = "/reservas" // aqui ponemos la vista a la que se cambiara
                }
            });
        } else {
            //console.log("Por favor seleccione horarios contiguos.");
            Swal.fire({
                icon: 'warning',
                title: 'Error',
                text: 'Por favor seleccione horarios contiguos.',
                confirmButtonText: 'Aceptar',
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
        title: 'Edicion cancelada',
        text: 'Has cancelado la Edicion de reserva.',
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
