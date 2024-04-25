@extends('reservas/admin/principal')

@section('contenido-pendientes')

<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <!-- FILTRADO -->
        <div class =" filtrado">
            <!-- CHECKBOX PARA FILTRAR LA LISTA DE RESERVAS -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Filtrado:
                </label>
            </div>
            <div class= "row" style="padding-left: 25px; padding-right: 25px;">
                <!-- RANGO DE LAS FECHAS INICIAL Y FINAL -->
                <div class="col">
                    <!-- Seleccionable de fecha inicial -->
                    <label for="fecha-name" class="col-form-label h4">Fecha inicial:</label>
                    <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                        <input name="fecha" id="fechaInput" class="form-control" type="text" readonly />               
                        <span class="input-group-addon"></span>
                    </div>
                </div>
                <div class="col">
                    <!-- Seleccionable de fecha final -->
                    <label for="fecha-name" class="col-form-label h4">Fecha final:</label>
                    <div id="datepicker-final" class="input-group date" data-date-format="dd-mm-yyyy">
                        <input name="fecha" id="fechaInput" class="form-control" type="text" readonly />               
                        <span class="input-group-addon"></span>
                    </div>
                </div>
            </div>
            <div class="buscar" style="text-align: right; padding-top: 20px; padding-right: 25px;">
                <button type="submit" class="btn btn-primary custom-btn"><i class="bi bi-search"></i> Buscar</button>
            </div>
        </div>

        <!-- TABLA DE LA LISTA DE RESERVAS DE LOS DOCENTES -->
        <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
            <table class="table table-striped table-hover table-bordered">
                <thead class="bg-custom-lista">
                    <tr>
                        <th class="text-center h4 text-white">Fecha</th>
                        <th class="text-center h4 text-white">Hora inicio</th>
                        <th class="text-center h4 text-white">Hora fin</th>
                        <th class="text-center h4 text-white">Docente</th>
                        <th class="text-center h4 text-white">Opciones</th>
                    </tr>
                </thead>
                <!-- Fila Ploma -->
                <thead class="bg-custom-lista-fila-plomo">	
                    <tr>
                        <th class="text-center h4 text-black">30-05-2024</th>
                        <th class="text-center h4 text-black">06:45</th>
                        <th class="text-center h4 text-black">09:45</th>
                        <th class="text-center h4 text-black">Leticia Blanco Coca</th>
                        <th class="text-center h4 text-black">
                            <div class="d-flex justify-content-center">
                                <!-- SI ES RESERVA INDIVIDUAL SE MUESTRA ESTA HOJA DE VER -->
                                <div class="circle2">
                                    <a href="{{ route('reservas.verIndividual')}}" class="btn btn-fab" title="Ver"> 
                                        <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                    </a>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead> 
                <!-- Fila blanca -->
                <thead class="bg-custom-lista-fila-blanco">
                    <tr>
                        <th class="text-center h4 text-black">30-04-2024</th>
                        <th class="text-center h4 text-black">11:15</th>
                        <th class="text-center h4 text-black">12:45</th>
                        <th class="text-center h4 text-black">Vladimir costas Jauregui</th>
                        <th class="text-center h4 text-black">
                            <div class="d-flex justify-content-center">
                                <!-- SI ES RESERVA GRUPAL SE MUESTRA ESTA HOJA DE VER -->
                                <div class="circle2">
                                    <a href="{{ route('reservas.verGrupal')}}" class="btn btn-fab" title="Ver"> 
                                        <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                    </a>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead> 	    
            </table>
        </div>
    </div>
</div>
@endsection