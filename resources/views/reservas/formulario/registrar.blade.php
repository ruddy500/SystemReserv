
@extends('reservas/principal')

@section('contenido-registrar')

<?php 
use App\Models\NombreAmbientes;
?>
{{-- {{ dd(get_defined_vars()) }} --}}

<div class="card-body bg-content">
    <div class="mb-3">
        <div class="row">
            <form id="consultaPeriodosForm" action="{{ route('reservas.consultarPeriodos') }}" method="POST">
                @csrf
                <div class="col">
                    <!-- Seleccionable de ambiente -->
                    <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                    <select name="ambiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                        
                        <option value="" disabled selected >Seleccione aula</option> 
                        <!-- me captura todo los ambientes -->       
                        @if(isset($ambientes_registrados))
                        @foreach($ambientes_registrados as $ambienteReg)  
                        @php
                      $nombreAmb = NombreAmbientes::find($ambienteReg->nombre_ambientes_id);
                     // dd($nombreAmb);
                      @endphp
                        <option value="{{ $nombreAmb->id }}"> {{ $nombreAmb->Nombre }} </option>
                         
                        @endforeach   
                        @endif
                    </select>
                    
                  
                    
                </div>

                <div class="col">
                    <!-- Seleccionable de fecha -->
                    <label for="fecha-name" class="col-form-label h4">Fecha:</label>
                    <div id="datepicker-reserva" class="input-group date" data-date-format="dd-mm-yyyy">
                        <input name="fecha" id="fechaInput" class="form-control" type="text" readonly />               
                        <span class="input-group-addon"></span>
                        <button id="btn-consultar" type="submit" class="btn btn-primary" style="">Consultar</button>
                    </div>
                </div>
            </form>
        </div>
{{-- {{ dd(get_defined_vars()) }} --}}
       
        <form id= "reservasForm" action="{{ route('checkbox.store') }}" method="POST">
            
            @csrf
        {{-- TABLA QUE MUESTRA PERIODOS Y ESTADOS --}}
@if(isset($horarios))
<div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto; display: block;">
    <table class="table table-striped table-hover table-bordered">
        <thead class="bg-custom-lista">
            <tr>
                <th class="text-center h4 text-white">Hora inicio</th>
				{{-- <th class="text-center h4 text-white">Periodo</th> --}}
                <th class="text-center h4 text-white">Hora fin</th>
                <th class="text-center h4 text-white">Estado</th>
                <th class="text-center h4 text-white">Selección</th>
            </tr>
        </thead>
        <tbody>
            
        

        {{-- @if(isset($horarios)) --}}
    @foreach($horarios as $horario)
        <tr>
            @php
                // Dividir el período en hora de inicio y hora de fin
                $horas = explode('-', $horario->nombre_periodo);

                $estado = ($horario->Estado) ? "Libre" : "Ocupado";

            @endphp

            <td>{{ $horas[0] }}</td> {{-- Hora de inicio --}}
            <td>{{ $horas[1] }}</td> {{-- Hora de fin --}}
            <td>{{ $estado}}</td>

            {{-- CHECKBOX SELECCIONABLE --}}

            {{-- <td>{{ $horario->Estado }}</td> --}}
            
            @if ($horario->Estado)
            <td class="text-center h4 text-black">
                <div class="d-flex justify-content-center">
                    <div>
                        <input class="form-check-input" name="options[]" type="checkbox" id="checkboxNoLabel" value="{{ $horario->fechas_id }}-{{ $horario->periodos_id }}-{{ $ambienteId }}" aria-label="..." data-estado={{ $horario->Estado  }} >
                    </div>
                </div>
            </td>
            {{-- ************************************* --}}
    
            @else
                
            <td class="text-center h4 text-black">
                <div class="d-flex justify-content-center">
                    <div>
                        <input class="form-check-input" name="options[]" type="checkbox" id="checkboxNoLabel" value="{{ $horario->fechas_id }}-{{ $horario->periodos_id  }}--{{ $ambienteId }}" aria-label="..." data-estado={{ $horario->Estado  }} disabled>
                    </div>
                </div>
            </td>

            @endif

        </tr>
    @endforeach

        </tbody>
    </table>
    {{-- <a href="{{ route('reservas.materias') }}" class="btn btn-primary custom-btn" id="btn-siguiente">Siguiente</a>  --}}
    

</div> 

        {{-- @include('reservas.formulario.horariosDisponibles') --}}
    </div>
</div>
<button type="submit">Siguiente</button>
@endif
{{-- <a href="#" id="btn-siguiente" class="btn btn-primary custom-btn">Siguiente</a> --}}
</form>              
<div id="mensaje-container"></div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checkedCount = 0;

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Si se ha seleccionado este checkbox
            if (this.checked) {
                checkedCount++;

                if (checkedCount === 2) {
                    checkboxes.forEach(function(cb) {
                        if (!cb.checked && cb.getAttribute('data-estado') === '1') {
                            cb.disabled = true;
                        }
                    });
                }
            } else {
                checkedCount--;

                // Habilita los checkboxes con estado 1
                checkboxes.forEach(function(cb) {
                    if (cb.getAttribute('data-estado') === '1') {
                        cb.disabled = false;
                    }
                });
            }
        });
    });
});
 </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el botón de consulta
        var btnConsultar = document.querySelector('button[type="submit"]');

        // Agregar un evento click al botón de consulta
        btnConsultar.addEventListener('click', function() {
            // Obtener los valores seleccionados
            var fechaSeleccionada = document.getElementById('fechaInput').value;
            var ambienteSeleccionado = document.querySelector('select[name="ambiente"]').value;

            // Almacenar los valores seleccionados en el almacenamiento local (localStorage)
            localStorage.setItem('fechaSeleccionada', fechaSeleccionada);
            localStorage.setItem('ambienteSeleccionado', ambienteSeleccionado);
        });

        // Restaurar los valores seleccionados al cargar la página
        var fechaGuardada = localStorage.getItem('fechaSeleccionada');
        var ambienteGuardado = localStorage.getItem('ambienteSeleccionado');

        if (fechaGuardada) {
            document.getElementById('fechaInput').value = fechaGuardada;
        }

        if (ambienteGuardado) {
            document.querySelector('select[name="ambiente"]').value = ambienteGuardado;
        }
    });
</script>


