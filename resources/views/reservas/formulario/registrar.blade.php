@extends('reservas/principal')

@section('contenido-registrar')
<div class="card-body bg-content">
    <div class="mb-3">
        <!-- Seleccionable de ambiente -->
        <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
        <select name="ambiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
            <option value="" disabled selected >Seleccione aula</option>    
        </select>
        <!-- Seleccionable de fecha -->
    </div>
</div>
@endsection