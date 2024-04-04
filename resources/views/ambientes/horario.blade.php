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
                        <select id="horario-select" class="selectpicker custom-select form-control btn-lg" multiple="true" data-size="5" data-actions-box="true" data-show-deselect-all="false" title="Seleccione horario">
                            <option value="1">Uno</option>
                            <option value="2">Dos</option>
                            <option value="3">Tres</option>
                            <option value="4">Cuatro</option>
                            <option value="5">Cinco</option>
                            <option value="6">Seis</option>
                            <option value="7">Siete</option>
                            <!-- Agregar más opciones aquí si es necesario -->
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-horario margin-end" data-bs-target="#" data-bs-whatever="@mdo">Añadir</button>
                    </div>
                </div>
                <!-- PRUEBA DE TABLA DE HORARIOS DISPONIBLES -->
                <label for="tablehorario-name" class="col-form-label h4">Horarios disponibles:</label>
                <table id="horario-tabla" class="table caption-top">
                    <thead>
                        <tr>
                        <th scope="col">Dia</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>Lunes</td>
                        <td>06:45-08:15</td>
                        <td>Libre</td>
                        </tr>

                        <tr>
                        <td>Lunes</td>
                        <td>15:45-17:15</td>
                        <td>Libre</td>
                        </tr>

                        <tr>
                        <td>Martes</td>
                        <td>Todos los horarios</td>
                        <td>Libre</td>
                        </tr>
                    </tbody>
                </table>
            
            </div>
        </div>
</div>
@endsection@