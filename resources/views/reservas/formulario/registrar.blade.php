
@extends('reservas/principal')

@section('contenido-registrar')
{{-- {{ dd(get_defined_vars()) }} --}}
<div class="card-body bg-content">
    <div class="mb-3">
        <div class="row">
            <form id="consultaPeriodosForm" action="{{ route('reservas.consultarPeriodos') }}" method="POST">
                @csrf
                <div class="col">
                    <!-- Seleccionable de ambiente -->
                    <label for="ambiente-name" class="col-form-label h4">Ambienteee:</label>
                    <select name="ambiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                        <option value="" disabled selected >Seleccione aula</option> 
                        <!-- me captura todo los ambientes -->
                        @foreach($nombreambientes as $nombreambiente)
                        <option value="{{ $nombreambiente->id }}"> {{ $nombreambiente->Nombre }} </option>
                        @endforeach    
                    </select>
                </div>
                <div class="col">
                    <!-- Seleccionable de fecha -->
                    <label for="fecha-name" class="col-form-label h4">Fecha:</label>
                    <div id="datepicker-reserva" class="input-group date" data-date-format="dd-mm-yyyy">
                        <input name="fecha" id="fechaInput" class="form-control" type="text" readonly />
                        {{-- <input id="fechaInput" name="fecha" class="form-control" type="date" required> --}}
                        <span class="input-group-addon"></span>
                        <button type="submit" class="btn btn-primary" style="">Consultar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabla que se mostrará cuando se seleccione una fecha -->
 {{-- <div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto; display: none;">
	<table class="table table-striped table-hover table-bordered">
		<thead class="bg-custom-lista">
			<tr>
			    <th class="text-center h4 text-white">Hora inicio</th>
				<th class="text-center h4 text-white">Hora fin</th>
				<th class="text-center h4 text-white">Estado</th>
				<th class="text-center h4 text-white">Selección</th>
			</tr>
		</thead>
    </table>
	<a href="{{ route('reservas.materias') }}" class="btn btn-primary custom-btn" id="btn-siguiente" >Siguiente</a>
</div>  --}}

<div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto; display: block;">
    <table class="table table-striped table-hover table-bordered">
        <thead class="bg-custom-lista">
            <tr>
                {{-- <th class="text-center h4 text-white">Hora inicio</th> --}}
				<th class="text-center h4 text-white">Periodo</th>
                {{-- <th class="text-center h4 text-white">Hora fin</th> --}}
                <th class="text-center h4 text-white">Estado</th>
                <th class="text-center h4 text-white">Selección</th>
            </tr>
        </thead>
        <tbody>
            
            @if(isset($horarios))
            {{-- {{ dd(get_defined_vars()) }} --}}
            @foreach($horarios as $horario)
                <tr>
                    <td>{{ $horario->nombre_periodo }}</td>
                    <td>{{ $horario->Estado }}</td>
                    {{-- <td>{{ $periodo->Estado }}</td>
                    <td>Seleccionar</td> --}}
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <a href="{{ route('reservas.materias') }}" class="btn btn-primary custom-btn" id="btn-siguiente">Siguiente</a>
</div> 

        {{-- @include('reservas.formulario.horariosDisponibles') --}}
    </div>
</div>
@endsection

<script>
    document.getElementById('fechaInput').addEventListener('change', function() {
        document.getElementById('consultaPeriodosForm').submit();
    });
</script>