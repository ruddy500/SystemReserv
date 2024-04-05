<div class="modal fade" id="formularioHorario" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="row g-3 needs-validation" action="" method="POST" novalidate>

                <!--'@'method('PUT') -->
                <div class="modal-header">
                    <h3 class="modal-title h3">Editar horario</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                        <div class="mb-3">
                            <label for="dia-name" class="col-form-label h4">Día:</label>
                            <select name="" class="form-control" required>

                                <option value="" disabled selected >Selecciona el dia</option>

                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miercoles</option>
                                <option value="1">Jueves</option>
                                <option value="2">Viernes</option>
                                <option value="3">Sábado</option>
                            </select>
                            <div class="valid-feedback">Dia seleccionado</div>
                            <div class="invalid-feedback">Seleccione el dia correspondiente</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="horario-name" class="col-form-label h4">Horario:</label>
                            <select name="" class="form-control" required>

                                <option value="" disabled selected >Selecciona el horario</option>

                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>

                            <div class="valid-feedback">Horario seleccionado</div>
                            <div class="invalid-feedback">Seleccione el horario correspondiente</div>
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