@extends('index')

@section('ambientes/horario')
<div class="container mt-3">
		<div class="card">
			<h3 class="card-header">Formulario registro de horario</h3>
            <div class="card-body bg-custom">
                <div class="row">
                <div class="col">
                    <label for="dia-name" class="col-form-label h4">Día:</label>
                    <select class="form-select" aria-label="Default select example">
                    <option selected>Seleccione dia</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    </select>
                </div>
                <div class="col">
                    <label for="horario-name" class="col-form-label h4">Horario:</label>
                    <select class="form-select" aria-label="Default select example">
                    <option selected>Seleccione horario</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    </select>
                </div>
                <button type="button" class="btn btn-custom margin" data-bs-target="#" data-bs-whatever="@mdo">Añadir</button>
            </div>
        </div>
    </div>
</div>
@endsection@