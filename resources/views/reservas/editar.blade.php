<div class="modal fade" id="formularioEditReserva" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content edith-reserva">
            <form class="row g-3" action="#" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title h3">Formulario edición de reserva</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-start">
                        <label for="ambiente-name" class="form-label h4">Ambiente:</label>
                        <select name="ambiente" class="form-select" aria-label="Small select example" required>
                            <option value="" disabled selected>Seleccione aula</option>
                        </select>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="cantidad-name" class="form-label h4">Cantidad estudiantes:</label>
                        <input type="number" name="cantidad" class="form-control" id="cantidad-name" required minlength="3" maxlength="100" min="30" max="200">
                    </div>
                    <div class="mb-3 text-start">
                        <label for="motivo-text" class="form-label h4">Motivo:</label>
                        <textarea class="form-control" name="motivo" id="motivo-text" required minlength="5" maxlength="100"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-aceptar">Aceptar</button>
                    <button type="button" class="btn btn-cancelar" >Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>