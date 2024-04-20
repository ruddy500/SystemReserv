@extends('reservas/principal')

@section('contenido-registrar')
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
        @include('reservas.formulario.horariosDisponibles')
    </div>
</div>
@endsection

<script>
    document.getElementById('fechaInput').addEventListener('change', function() {
        document.getElementById('consultaPeriodosForm').submit();
    });
</script>