@extends('index')

@section('ambientes/editar')

<div class="container mt-3">
		<div class="card">
			<h3 class="card-header">Editar ambiente</h3>
            <div class="card-body bg-custom">
            <form class="row g-3 needs-validation" action="" method="POST" novalidate>
            @csrf
            @include('componentes.validacion')
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                            <select name="ambiente" class="form-control form-select-sm h4" aria-label="Small select example" required>
                                <option value="" disabled selected >Selecciona una aula</option>
                                <!-- Aqui recoger el dato de nombre de ambiente -->
                                <option value="" >Poner nombre ambiente 1</option>
                                <option value="" >Poner nombre ambiente 2</option>
                                <option value="" >Poner nombre ambiente 3</option>
                            </select>
                            <div class="valid-feedback">Aula seleccionada</div>
                            <div class="invalid-feedback">Seleccione un aula para el cambio</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>
                            <input type="number" name= "capacidad" class="form-control" id="capacidad-name" required minlength="3" maxlength="100" min="30" max="200">
                            <div class="valid-feedback">Capacidad válida</div>
                            <div class="invalid-feedback">Inserte un rango entre 30 a 200 de capacidad</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                    <textarea class="form-control" name = "descripcion" id="descripcion-ubicacion-text" required></textarea>
                    <div class="valid-feedback">Descripcion válida</div>
                    <div class="invalid-feedback">Inserte una descripcion entre 10 a 50 caracteres</div>
                </div>
                <label for="tablehorario-name" class="col-form-label h4">Horarios disponibles:</label>
                <table id="horario-tabla" class="table caption-top">
                    <thead>
                        <tr>
                        <th scope="col">Habilitar</th>
                        <th scope="col">Día</th>
                        <th scope="col">Horario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-bs-toggle="modal" data-bs-target="#formularioHorario" data-bs-whatever="@mdo">
                        @include('ambientes.ambiente.editHorario')
                            <td>poner switch</td>
                            <td>Lunes</td>
                            <td>06:45-08:15</td>
                        </tr>

                        <tr data-bs-toggle="modal" data-bs-target="#formularioHorario" data-bs-whatever="@mdo">
                        @include('ambientes.ambiente.editHorario')
                            <td>poner switch</td>
                            <td>Lunes</td>
                            <td>15:45-17:15</td>
                        </tr>
                    </tbody>
                </table>
                <div class="horario-footer">
                    <button type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button type="button" class="btn btn-cancelar">Cancelar</button>
                </div>
            </form>
            </div>
        </div>
</div>

@endsection