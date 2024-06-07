<!-- Modal -->
<div class="modal fade" id="formularioEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de evento </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="formulario-anuncio" action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <!-- CAMPO NOMBRE DE EVENTO -->
                        <div class="mb-3">
                            <label for="formTitulo-Anuncio" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="titulo-anuncio">
                        </div>
                        <!-- CAMPO FECHA INCIAL -->
                        <div class="mb-3">
                            <label for="fecha-name" class="col-form-label h4">Fecha inicial:</label>
                            <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                <input name="fecha" class="form-control" type="text" readonly />
                                <span class="input-group-addon"></span>
                            </div>
                        </div>
                        <!-- CAMPO FECHA FINAL -->
                        <div class="mb-3">
                            <label for="fecha-name" class="col-form-label h4">Fecha final:</label>
                            <div id="datepicker-final" class="input-group date" data-date-format="dd-mm-yyyy">
                                <input name="fecha" class="form-control" type="text" readonly />
                                <span class="input-group-addon"></span>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <!-- Agrega un evento onclick para mostrar la alerta de éxito -->
                            <button type="button" class="btn btn-aceptar" onclick="">Aceptar</button>
                            <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>