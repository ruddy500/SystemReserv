@extends('index')

@section('reservas/editar')

{{-- {{ dd(get_defined_vars()) }}  --}}
<?php 
use App\Models\Eventos;

$eventos = Eventos::all();

$fechas = [];
foreach ($eventos as $evento) {
    $fechaInicio = \DateTime::createFromFormat('d-m-Y', $evento->FechaInicial);
    $fechaInF = $fechaInicio->format('Y-m-d');

    $fechaFinal = \DateTime::createFromFormat('d-m-Y', $evento->FechaFinal);
    $fechaFinF = $fechaFinal->format('Y-m-d');

    // Incrementar la fecha inicial para incluirla en el array
    $fecha = new \DateTime($fechaInF); // Crear objeto DateTime desde la fecha inicial
    while ($fecha <= $fechaFinal) {
        $fechas[] = $fecha->format('Y-m-d');
        $fecha->modify('+1 day');
    }

        
    }



?>

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
                                <div class="input-group date datepicker" >
                            
                                    <input name="fecha" class="form-control" type="text" value="{{ old('fechaRF', $fechaRF->format('d-m-Y')) }}"  readonly />
              
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
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
                                            @if (count($periodosSeleccionados)==1)
                                                <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="{{$periodo->id}}" aria-label="..." {{ $periodo->id == $periodosSeleccionados[0] ? 'checked' : '' }} >    
                                            @else
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="{{$periodo->id}}" aria-label="..." {{ $periodo->id == $periodosSeleccionados[0]|| $periodo->id == $periodosSeleccionados[1]  ? 'checked' : '' }} >
                                            @endif
                                            
                                           
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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Datepicker localization -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
  

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Datepicker initialization
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '+0d',
            language: 'es',
            autoclose: true,
            daysOfWeekDisabled: [0],
            todayHighlight: true,
            beforeShowDay: function(date) {
                // Asumiendo que $fechas está correctamente definido en tu PHP
                var disabledDates = <?php echo json_encode($fechas); ?>;
                var formattedDate = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
                return {
                    enabled: !(Array.isArray(disabledDates) && disabledDates.includes(formattedDate))
                };
            }

          
        });

        

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

