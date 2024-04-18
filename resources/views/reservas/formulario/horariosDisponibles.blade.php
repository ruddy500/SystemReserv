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
		<!-- Fila Ploma -->
        <thead class="bg-custom-lista-fila-plomo">	
            <tr>
                <th class="text-center h4 text-black">08:15</th>
                <th class="text-center h4 text-black">11:15</th>
				<th class="text-center h4 text-black">Libre</th>
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
                <th class="text-center h4 text-black">15:45</th>
                <th class="text-center h4 text-black">17:15</th>
                <th class="text-center h4 text-black">Libre</th>
                <th class="text-center h4 text-black">
                    <div class="d-flex justify-content-center">
						<div>
							<input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
						</div>
					</div>
                </th>
            </tr>	
        </thead>

		<!-- EJEMPLO DE COMO SE DEBE MOSTRAR CUANDO UN HORARIO ESTA OCUPADO -->
        <thead class="bg-custom-lista-fila-plomo">	
            <tr>
                <th class="text-center h4 text-black">08:15</th>
                <th class="text-center h4 text-black">11:15</th>
				<th class="text-center h4 text-black">Ocupado</th>
                <th class="text-center h4 text-black">
                    <div class="d-flex justify-content-center">
						<div>
							<!-- Se deshabilita la opcion del checkbox -->
							<input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="" disabled>
						</div>
					</div>
                </th>
            </tr>
        </thead>
    </table>
	<a href="{{ route('reservas.materias') }}" class="btn btn-primary custom-btn" id="btn-siguiente" >Siguiente</a>
</div>
