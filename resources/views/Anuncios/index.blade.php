@extends('index')

@section('anuncios')
<div class="container mt-3">
	<div class="card">
		<h3 class="card-header">Anuncios</h3>
		<div class="card-body">
            <div class="boton-anuncio">
                <button type="button" class="btn btn-primary custom-btn" data-bs-toggle="modal" data-bs-target="#formularioAnuncio" data-bs-whatever="@mdo">Registrar anuncio</button>
            </div>
            <!-- INCLUYE EL MODAL DE REGISTRO DE ANUNCIO-->
			@include('anuncios.registro')
            <!-- TABLA DE LISTA DE ANUNCIOS -->
            <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
				<table class="table table-striped table-hover table-bordered">
					<thead class="bg-custom-lista">
						<tr>
							<th class="text-center h4 text-white">Fecha</th>
							<th class="text-center h4 text-white">Hora</th>
							<th class="text-center h4 text-white">Titulo</th>
							<th class="text-center h4 text-white">Opciones</th>
						</tr>
					</thead>
                    <tbody> 
                        <thead class="bg-custom-lista-fila-blanco">
                            <tr>
                                <th class="text-center h4 text-black">21-05-2024</th>
                                <th class="text-center h4 text-black">17:15:55</th>
                                <th class="text-center h4 text-black">Reglas de uso de ambiente</th>
                                <!-- BOTON ELIMINAR ANUNCIO -->
                                <th class="text-center h4 text-black">
                                    <div class="d-flex justify-content-center">
                                        <div class="circle5">
                                            <a href="#" class="btn btn-fab" title="Eliminar"> 
                                                <i class="bi bi-trash3-fill" style="color: white;"></i>
                                            </a>						
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection