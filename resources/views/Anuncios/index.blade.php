@extends('index')

@section('anuncios')
<div class="container mt-3">
    <div class="card">
        <h3 class="card-header">Anuncios</h3>
        <div class="card-body">
            <div class="boton-anuncio">
                <button type="button" class="btn btn-primary dropdown-toggle custom-btn" data-bs-toggle="dropdown" aria-expanded="false">
				Registrar
				</button>
				<ul class="dropdown-menu">
				<li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#formularioAnuncio" data-bs-whatever="@mdo">Anuncios Importantes</button></li>
			    <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#formularioReglas" data-bs-whatever="@mdo">Reglas de Ambientes</button></li>
				</ul>
            </div>
            <!-- INCLUYE EL MODAL DE REGISTRO DE ANUNCIO Y REGLAS-->
            @include('anuncios.registro')
            @include('anuncios.reglas')
            <!-- TABLA DE LISTA DE ANUNCIOS -->
            <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                <label class="col-form-label w-25 bg-custom-lista text-white" style="display: block; padding: 3px; margin-bottom: 10px;">
                    <i class="bi bi-exclamation-triangle"></i> Reglas de Ambientes
                </label>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="bg-custom-lista">
                        <tr>
                            <th class="text-center h4 text-white">Fecha</th>
                            <th class="text-center h4 text-white">Hora</th>
                            <th class="text-center h4 text-white">Reglas</th>
                            <th class="text-center h4 text-white">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0;$i<$tam;$i++)
                            <tr class="bg-custom-lista-fila-blanco">
                                <td class="text-center h4 text-black">{{$anuncios[$i]->Fecha}}</td>
                                <td class="text-center h4 text-black">{{$anuncios[$i]->Hora}}</td>
                                <td class="h4 text-black"><strong>Regla #{{$i+1}}:</strong> {{$anuncios[$i]->Titulo}}</td>
                                <!-- BOTON ELIMINAR ANUNCIO -->
                                <td class="text-center h4 text-black">
                                    <div class="d-flex justify-content-center">
                                        <div class="circle5">
                                        <form method="POST" action="{{ url('/guardar-ids') }}">
                                            @csrf <!-- Agregar el token CSRF -->
                                                <a href="#" class="btn btn-fab btn-eliminar" title="Eliminar"> 
                                                    <i class="bi bi-trash3-fill" style="color: white;"></i>
                                                    <input type="hidden" name="id-anuncio" id="id-anuncio" value="{{$anuncios[$i]->id}}">
                                                </a>                        
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- TABLA DE LISTA DE ANUNCIOS -->
            <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                <label class="col-form-label bg-custom-lista w-25 text-white" style="display: block; padding: 3px; margin-bottom: 10px;">
                    <i class="bi bi-pin"></i> Anuncios Importantes
                </label>
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
                        @for ($i=0;$i<$tam;$i++)
                            <tr class="bg-custom-lista-fila-blanco">
                                <td class="text-center h4 text-black">{{$anuncios[$i]->Fecha}}</td>
                                <td class="text-center h4 text-black">{{$anuncios[$i]->Hora}}</td>
                                <td class="text-center h4 text-black">{{$anuncios[$i]->Titulo}}</td>
                                <!-- BOTON ELIMINAR ANUNCIO -->
                                <td class="text-center h4 text-black">
                                    <div class="d-flex justify-content-center">
                                        <div class="circle5">
                                        <form method="POST" action="{{ url('/guardar-ids') }}">
                                            @csrf <!-- Agregar el token CSRF -->
                                                <a href="#" class="btn btn-fab btn-eliminar" title="Eliminar"> 
                                                    <i class="bi bi-trash3-fill" style="color: white;"></i>
                                                    <input type="hidden" name="id-anuncio" id="id-anuncio" value="{{$anuncios[$i]->id}}">
                                                </a>                        
                                            </div> 
                                        </form>

                                            @if(session('success'))
                                                <script>
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: '{{ session('success') }}',
                                                        confirmButtonText: 'Aceptar'
                                                    });
                                                </script>
                                            @endif 

                                            @if(session('message'))
                                                <script>
                                                    Swal.fire({
                                                        icon: 'warning',
                                                        title: '{{ session('message') }}',
                                                        confirmButtonText: 'Aceptar'
                                                    });
                                                </script>
                                            @endif
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-eliminar');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: '¿Está seguro de eliminar el anuncio?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28A745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Enviar el formulario si el usuario confirma
                }
            })
        });
    });
});
</script> 
@endsection
