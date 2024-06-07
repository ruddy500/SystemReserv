@extends('calendario/principal')

@section('contenido-evento')
<div class="cont-envento">
    <div class="boton-evento">
        <button type="button" class="btn btn-primary custom-btn" data-bs-toggle="modal" data-bs-target="#formularioEvento" data-bs-whatever="@mdo" style="margin-top:20px;">Registrar evento</button>
    </div>
    <!-- INCLUYE EL MODAL DE REGISTRO DE EVENTO-->
	@include('calendario.registro')
    <!-- TABLA DE LISTA DE EVENTOS-->
    <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
		<table class="table table-striped table-hover table-bordered">
			<thead class="bg-custom-lista">
				<tr>
					<th class="text-center h4 text-white">Nombre</th>
					<th class="text-center h4 text-white">Fecha inicio</th>
                    <th class="text-center h4 text-white">Fecha fin</th>
					<th class="text-center h4 text-white">Opciones</th>
				</tr>
			</thead>
            <!-- CONTENIDO TABLA -->
            <tbody> 
                <thead class="bg-custom-lista-fila-blanco">
                    <tr>
                        <th class="text-center h4 text-black">Dia del ingeniebrio</th>
                        <th class="text-center h4 text-black">21-05-2024</th>
                        <th class="text-center h4 text-black">21-05-2024</th>
                        <!-- BOTON ELIMINAR EVENTOS -->
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
@endsection