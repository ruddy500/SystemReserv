@extends('index')

@section('reservas/editar')
<div class="container mt-3">
	<div class="card vercard">
		<h3 class="card-header">Editar reserva</h3>
        <div class="card-body bg-content">
            <div class="row">
                <form id="" method="POST">
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
                    <!-- BOTONES ACEPTAR Y CANCELAR -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-aceptar">Aceptar</button>
                        <button id="cancelar" type="button" class="btn btn-cancelar">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection