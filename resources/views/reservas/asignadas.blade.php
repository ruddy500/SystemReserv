@extends('reservas/principal')

@section('contenido-asignadas')
<div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
	<table class="table table-striped table-hover table-bordered">
		<thead class="bg-custom-lista">
			<tr>
                <th class="text-center h4 text-white">Fecha</th>
				<th class="text-center h4 text-white">Hora inicio</th>
				<th class="text-center h4 text-white">Hora fin</th>
                <th class="text-center h4 text-white">Motivo</th>
                <th class="text-center h4 text-white">Opciones</th>
			</tr>
		</thead>
        <!-- Fila Ploma -->
        <!-- <thead class="bg-custom-lista-fila-plomo">	
            <tr>
                <th class="text-center h4 text-black">691 A</th>
                <th class="text-center h4 text-black">28-04-2024</th>
                <th class="text-center h4 text-black">06:45</th>
                <th class="text-center h4 text-black">11:15</th>
                <th class="text-center h4 text-black">
                    <div class="d-flex justify-content-center">
                        <div class="circle2">
						    <a href="#" class="btn btn-fab" title="Ver"> 
							    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
						    </a>
                        </div>
					</div>
                </th>
            </tr>
        </thead> -->
        <!-- Fila blanca -->
        <!-- <thead class="bg-custom-lista-fila-blanco">
            <tr>
                <th class="text-center h4 text-black">692 B</th>
                <th class="text-center h4 text-black">30-04-2024</th>
                <th class="text-center h4 text-black">15:45</th>
                <th class="text-center h4 text-black">17:15</th>
                <th class="text-center h4 text-black">
                    <div class="d-flex justify-content-center">
                        <div class="circle2">
						    <a href="#" class="btn btn-fab" title="Ver"> 
							    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
						    </a>
                        </div>
					</div>
                </th>
            </tr>	
        </thead> -->
	</table>
</div>
@endsection