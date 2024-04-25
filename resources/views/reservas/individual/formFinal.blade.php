@extends('reservas/principal')

@section('contenido-registrarIndividual')
<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="row">
            <!-- FORMULARIO -->
            <form id="" method="POST">
                <!-- Campo para poner la cantidad de estudiantes totales -->
                <div class="col">
                    <label for="totalEstudiantes-name" class="col-form-label h4">Total estudiantes: 190</label>
                </div>
                <div class="col">
                    <!-- Campo de cantidad de estudiantes y motivo en la misma fila -->
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="cantidad-name" class="col-form-label h4">Cantidad de estudiantes:</label>
                                <input type="number" name="cantidad" class="form-control" id="cantidad-name" minlength="3" maxlength="100" min="10" max="300" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="motivo-name" class="col-form-label h4">Motivo:</label>
                                <select name="motivo" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                    <option value="" disabled selected>Seleccione motivo</option>
                                    <option>Examen primer parcial</option>
                                    <option>Examen segundo parcial</option> 
                                    <option>Examen final</option> 
                                    <option>Examen segunda instancia</option> 
                                    <option>Examen de mesa</option> 
                                    <option>Taller</option> 
                                    <option>Seminario</option>      
                                </select> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <!-- Seleccionable de fecha -->
                            <label for="fecha-name" class="col-form-label h4">Fecha:</label>
                            <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                <input name="fecha" id="fechaInput" class="form-control" type="text" readonly />               
                                <span class="input-group-addon"></span>
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
                            <form id="reservasForm" action="" method="post">
                                <!-- Fila Ploma -->
                                <thead class="bg-custom-lista-fila-plomo">	
                                    <tr>
                                        <th class="text-center h4 text-black">06:45</th>
                                        <th class="text-center h4 text-black">08:15</th>
                                        <th class="text-center h4 text-black">
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <!-- Fila blanca -->
                                <thead class="bg-custom-lista-fila-blanco">
                                    <tr>
                                        <th class="text-center h4 text-black">08:15</th>
                                        <th class="text-center h4 text-black">09:45</th>
                                        <th class="text-center h4 text-black">
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>	
                                </thead>
                                <!-- Fila Ploma -->
                                <thead class="bg-custom-lista-fila-plomo">	
                                    <tr>
                                        <th class="text-center h4 text-black">09:45</th>
                                        <th class="text-center h4 text-black">11:15</th>
                                        <th class="text-center h4 text-black">
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </form>
                        </table>
                    </div>
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
@endsection