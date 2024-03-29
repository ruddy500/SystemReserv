<div class="modal fade" id="formularioAmbiente" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title h3">Formulario de ambiente</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                        <div class="mb-3">
                            <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                            <select class="form-control form-select-sm h4" aria-label="Small select example" required>
                                <option value="" disabled selected>Seleccionar un ambiente</option>
                                
                                    <option value="1">Ambiente 1</option>
                                    <option value="2">Ambiente 2</option>
                                    <option value="3">Ambiente 3</option>
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>
                            <input type="number" class="form-control" id="capacidad-name" required minlength="3" maxlength="100" min="30" max="200">
                            <div class="valid-feedback">Capacidad válida</div>
                            <div class="invalid-feedback">Inserte un rango entre 30 a 200 de capacidad</div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                            <textarea class="form-control" id="descripcion-ubicacion-text" required minlength="10" maxlength="50"></textarea>
                            <div class="valid-feedback">Descripcion válida</div>
                            <div class="invalid-feedback">Inserte una descripcion entre 10 a 50 caracteres</div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


