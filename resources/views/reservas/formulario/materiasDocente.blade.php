@extends('reservas/principal')

@section('contenido-registrar')
<div class="card-body bg-content">
    <div class="mb-3">
        <!-- Tabla que se mostrará cuando se seleccione una fecha -->
        <label for="materia-name" class="col-form-label h4">Materia:</label>
        <div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
            <table class="table table-striped table-hover table-bordered">
                <thead class="bg-custom-lista">
                    <tr>
                        <th class="text-center h4 text-white">Nombre</th>
                        <th class="text-center h4 text-white">Grupo</th>
                        <th class="text-center h4 text-white">Selección</th>
                    </tr>
                </thead>
                <!-- Fila Ploma -->
                <thead class="bg-custom-lista-fila-plomo">	
                    <tr>
                        <th class="text-center h4 text-black">Introduccion a la programación</th>
                        <th class="text-center h4 text-black">2</th>
                        <th class="text-center h4 text-black">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <!-- Fila blanca -->
                <thead class="bg-custom-lista-fila-blanco">
                    <tr>
                        <th class="text-center h4 text-black">Arquitectura de computadoras</th>
                        <th class="text-center h4 text-black">3</th>
                        <th class="text-center h4 text-black">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                                </div>
                            </div>
                        </th>
                    </tr>	
                </thead>
            </table>
            <a href="{{ route('reservas.formFinal') }}" class="btn btn-primary custom-btn" id="btn-siguiente" >Siguiente</a>
        </div>
    </div>
</div>
@endsection