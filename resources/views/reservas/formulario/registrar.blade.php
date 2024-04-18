@extends('reservas/principal')

@section('contenido-registrar')
<div class="card-body bg-content">
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <!-- Seleccionable de ambiente -->
                <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                <select name="ambiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                    <option value="" disabled selected >Seleccione aula</option>    
                </select>
            </div>
            <div class="col">
                <!-- Seleccionable de fecha -->
                <label for="fecha-name" class="col-form-label h4">Fecha:</label>
                <div id="datepicker-reserva" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly placeholder="dd-mm-aaaa"/>
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>
        @include('reservas.formulario.horariosDisponibles')
    </div>
</div>
@endsection