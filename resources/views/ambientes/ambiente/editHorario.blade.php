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

                                <option value="" disabled selected >Seleccione día</option>

                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miercoles</option>
                                <option value="1">Jueves</option>
                                <option value="2">Viernes</option>
                                <option value="3">Sábado</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="horario-name" class="col-form-label h4">Horario:</label>
                            <select name="" class="form-control" required>

                                <option value="" disabled selected >Seleccione horario</option>

                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button id="cancelar2" type="button" class="btn btn-cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('#cancelar2').on('click', function() {
        Swal.fire({
        title: "Cancelado",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#7066e0",
        confirmButtonText: "Aceptar" ,
        allowOutsideClick: false
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/ambientes/editar';
        }
        });
    });
</script>