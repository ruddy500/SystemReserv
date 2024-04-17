<!-- Tabla que se mostrará cuando se seleccione una fecha -->
<div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto; display: none;">
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
</div>
