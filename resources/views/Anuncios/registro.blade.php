<!-- Modal -->
<div class="modal fade" id="formularioAnuncio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de anuncio </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="formulario-anuncio" action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <!-- CAMPO TITULO DE ANUNCIO -->
                        <div class="mb-3">
                            <label for="formTitulo-Anuncio" class="form-label">Titulo:</label>
                            <input type="text" class="form-control" id="titulo-anuncio">
                        </div>
                        <!-- CAMPO CONTENIDO ANUNCIO -->
                        <div class="mb-3">
                            <label for="formContenido-Contenido" class="form-label">Contenido:</label>
                            <textarea class="form-control" name="contenido-anuncio" id="contenido-anuncio-text"></textarea>
                        </div>
                    
                        <div class="modal-footer">
                            <!-- Agrega un evento onclick para mostrar la alerta de éxito -->
                            <button type="button" class="btn btn-aceptar" onclick="">Publicar</button>
                            <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>