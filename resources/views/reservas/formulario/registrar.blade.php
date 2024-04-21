
@extends('reservas/principal')

@section('contenido-registrar')
{{-- {{ dd(get_defined_vars()) }} --}}

<div class="card-body bg-content">
    <div class="mb-3">
        <div class="row">
            <form id="consultaPeriodosForm" action="{{ route('reservas.consultarPeriodos') }}" method="POST">
                @csrf
                <div class="col">
                    <!-- Seleccionable de ambiente -->
                    <label for="ambiente-name" class="col-form-label h4">Ambienteee:</label>
                    <select name="ambiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                        <option value="" disabled selected >Seleccione aula</option> 
                        <!-- me captura todo los ambientes -->
                        @foreach($nombreambientes as $nombreambiente)
                        <option value="{{ $nombreambiente->id }}"> {{ $nombreambiente->Nombre }} </option>
                        @endforeach    
                    </select>
                </div>

                <div class="col">
                    <!-- Seleccionable de fecha -->
                    <label for="fecha-name" class="col-form-label h4">Fecha:</label>
                    <div id="datepicker-reserva" class="input-group date" data-date-format="dd-mm-yyyy">
                        <input name="fecha" id="fechaInput" class="form-control" type="text" readonly />
                        {{-- <input id="fechaInput" name="fecha" class="form-control" type="date" required> --}}
                        <span class="input-group-addon"></span>
                        <button type="submit" class="btn btn-primary" style="">Consultar</button>
                    </div>
                </div>
            </form>
        </div>
       
        <form id= "reservasForm" action="{{ route('checkbox.store') }}" method="POST">
            
            @csrf
        {{-- TABLA QUE MUESTRA PERIODOS Y ESTADOS --}}
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
            
        

        @if(isset($horarios))
    @foreach($horarios as $horario)
        <tr>
            @php
                // Dividir el período en hora de inicio y hora de fin
                $horas = explode('-', $horario->nombre_periodo);
           
            @endphp

            <td>{{ $horas[0] }}</td> {{-- Hora de inicio --}}
            <td>{{ $horas[1] }}</td> {{-- Hora de fin --}}
            <td>{{ $horario->Estado }}</td>
            
            @if ($horario->Estado)
            
            <td class="text-center h4 text-black">
                <div class="d-flex justify-content-center">
                    <div>
                        <input class="form-check-input" name="options[]" type="checkbox" id="checkboxNoLabel" value="{{ $horario->fechas_id }}-{{ $horario->periodos_id }}" aria-label="..." data-estado={{ $horario->Estado  }} >
                    </div>
                </div>
            </td>
    
            @else
                
            <td class="text-center h4 text-black">
                <div class="d-flex justify-content-center">
                    <div>
                        <input class="form-check-input" name="options[]" type="checkbox" id="checkboxNoLabel" value="{{ $horario->fechas_id }}-{{ $horario->periodos_id  }}" aria-label="..." data-estado={{ $horario->Estado  }} disabled>
                    </div>
                </div>
            </td>

            @endif

        </tr>
    @endforeach
@endif

        </tbody>
    </table>
    {{-- <a href="{{ route('reservas.materias') }}" class="btn btn-primary custom-btn" id="btn-siguiente">Siguiente</a> --}}
    

</div> 

        {{-- @include('reservas.formulario.horariosDisponibles') --}}
    </div>
</div>
<button type="submit">Siguiente</button>
{{-- <a href="#" id="btn-siguiente" class="btn btn-primary custom-btn">Siguiente</a> --}}

</form>
                

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
        
