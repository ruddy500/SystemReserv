@extends('index')

@section('ambientes/editar')

<div class="container mt-3">
		<div class="card">
			<h3 class="card-header">Editar ambiente</h3>
            <div class="card-body bg-custom">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                            <select name="ambiente" class="form-control form-select-sm h4" aria-label="Small select example" required disabled>
                                <!-- Aqui recoger el dato de nombre de ambiente -->
                                <option value="" disabled selected>Poner nombre ambiente</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>
                            <input type="number" name= "capacidad" class="form-control" id="capacidad-name">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                    <textarea class="form-control" name = "descripcion" id="descripcion-ubicacion-text"></textarea>
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
                        <tr>
                        <td>poner switch</td>
                        <td>Lunes</td>
                        <td>06:45-08:15</td>
                        
                        </tr>

                        <tr>
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
            </div>
        </div>
</div>

@endsection@