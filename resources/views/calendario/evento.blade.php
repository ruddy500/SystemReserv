@extends('calendario/principal')

@section('contenido-evento')
{{-- {{ dd(get_defined_vars()) }} --}}
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
                @foreach ( $eventos as $evento )
                <thead class="bg-custom-lista-fila-blanco">
                    <tr>
                        <th class="text-center h4 text-black">{{ $evento->Nombre }}</th>
                        <th class="text-center h4 text-black">{{ $evento->FechaInicial }}</th>
                        <th class="text-center h4 text-black">{{ $evento->FechaFinal }}</th>
                        <!-- BOTON ELIMINAR EVENTOS -->
                        <th class="text-center h4 text-black">
                            <div class="d-flex justify-content-center">
                                <div class="circle5">
                                    <a href="#" class="btn btn-fab btn-eliminar" title="Eliminar"> 
                                        <i class="bi bi-trash3-fill" style="color: white;"></i>
                                    </a>						
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                @endforeach
              
            </tbody>
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-eliminar');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: '¿Está seguro de eliminar el Evento?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28A745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Aquí puedes agregar la lógica para eliminar el anuncio
                        Swal.fire({
                            title: 'Eliminado',
                            text: "¡El evento ha sido eliminado",
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                        })
                    }
                })
            });
        });
    });
</script>
@endsection