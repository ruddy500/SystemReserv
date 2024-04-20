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
{{ dd(get_defined_vars()) }}

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
            
            @foreach($horarios as $horario)
                <tr>
                    <td>{{ $horario->nombre_periodo }}</td>
                    <td>{{ $horario->Estado }}</td>
                    {{-- <td>{{ $periodo->Estado }}</td>
                    <td>Seleccionar</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('reservas.materias') }}" class="btn btn-primary custom-btn" id="btn-siguiente">Siguiente</a>
</div> 
