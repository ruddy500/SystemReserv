@extends('anuncios/index')

@section('contenido-reglas')

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
                        @for ($i=0;$i<$t;$i++)
                            <tr class="bg-custom-lista-fila-blanco">
                                <td class="text-center h4 text-black">{{$reglas[$i]->Fecha}}</td>
                                <td class="text-center h4 text-black">{{$reglas[$i]->Hora}}</td>
                                <td class="h4 text-black">{{$reglas[$i]->Regla}}</td>
                                <!-- BOTON ELIMINAR ANUNCIO -->
                                <td class="text-center h4 text-black">
                                    <div class="d-flex justify-content-center">
                                        <div class="circle5">
                                        <form method="POST" action="{{ url('/guardar-ids-regla') }}">
                                            @csrf <!-- Agregar el token CSRF -->
                                                <a href="#" id="btn-eliminar" class="btn btn-fab btn-eliminar" title="Eliminar"> 
                                                    <i class="bi bi-trash3-fill" style="color: white;"></i>
                                                    <input type="hidden" name="id-regla" id="id-regla" value="{{$reglas[$i]->id}}">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-eliminar');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: '¿Está seguro de eliminar la regla?',
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