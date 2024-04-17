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
            </table>
            <a href="{{ route('reservas.formFinal') }}" class="btn btn-primary custom-btn" id="btn-siguiente" >Siguiente</a>
        </div>
    </div>
</div>
@endsection