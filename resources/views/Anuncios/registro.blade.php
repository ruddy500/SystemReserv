<!-- Modal -->
<div class="modal fade" id="formularioAnuncio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Anuncio Importante</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="formulario-anuncio" method="POST" action="{{ url('/guardar-anuncio') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf <!-- Agregar el token CSRF -->
                        @include('componentes.validacion')
                        <!-- CAMPO TITULO DE ANUNCIO -->
                        <div class="mb-3">
                            <label for="titulo-anuncio" class="form-label">Titulo:</label>
                            <input type="text" class="form-control" name="titulo-anuncio" id="titulo-anuncio" required>
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>
                        <!-- CAMPO CONTENIDO ANUNCIO -->
                        <div class="mb-3">
                            <label for="contenido-anuncio-text" class="form-label">Descripción:</label>
                            <textarea class="form-control" name="contenido-anuncio" id="contenido-anuncio" required></textarea>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <!-- Botón Publicar con SweetAlert2 -->
                            <button type="submit" class="btn btn-aceptar" id="btn-publicar">Publicar</button>
                            <!-- Botón Cancelar con SweetAlert2 -->
                            <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>   
                        @if(session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: '{{ session('success') }}',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>
                        @endif 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Alerta de SweetAlert2 para el botón Cancelar
document.getElementById('btn-cancelar').addEventListener('click', function() {
    Swal.fire({
        icon: 'warning',
        title: 'Aviso cancelado',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Resetear el formulario
            document.getElementById('formulario-anuncio').reset();
        }
    })
})
</script>