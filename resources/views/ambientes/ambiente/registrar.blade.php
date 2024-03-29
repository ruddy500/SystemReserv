<div class="modal fade" id="formularioAmbiente" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title h3">Formulario de ambiente</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                        <select class="form-select form-select-sm h4" aria-label="Small select example">
                            <option selected>Seleccione ambiente</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>
                        <input type="text" class="form-control" id="capacidad-name">
                    </div>

                    <div class="mb-3">
                        <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                        <textarea class="form-control" id="descripcion-ubicacion-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-aceptar">Aceptar</button>
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>