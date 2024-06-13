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
                    <form id="formulario-anuncio" action="{{ route('calendario.evento.registrar') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                      
                        <!-- CAMPO NOMBRE DE EVENTO -->
                        <div class="mb-3">
                            <label for="formTitulo-Anuncio" class="form-label">Nombre:</label>
                            <input name="nombre_evento" type="text" class="form-control" id="titulo-anuncio" required>
                            <div class="invalid-feedback">
                               
                            </div>
                        </div>
                        <!-- CAMPO FECHA INICIAL -->
                        <div class="mb-3">
                            <label for="fecha-name" class="col-form-label h4">Fecha inicial:</label>
                            <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                <input name="fecha_inicial" class="form-control" type="text" readonly placeholder="dd-mm-aaaa" required>
                                <span class="input-group-addon"></span>
                                <div class="invalid-feedback">
                                   
                                </div>
                            </div>
                        </div>
                        <!-- CAMPO FECHA FINAL -->
                        <div class="mb-3">
                            <label for="fecha-name" class="col-form-label h4">Fecha final:</label>
                            <div id="datepicker-final" class="input-group date" data-date-format="dd-mm-yyyy">
                                <input name="fecha_final" class="form-control" type="text" readonly placeholder="dd-mm-aaaa" required>
                                <span class="input-group-addon"></span>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <!-- Cambia el tipo de botón a "submit" para el formulario -->
                            <button type="submit" class="btn btn-aceptar">Aceptar</button>
                            <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script de validación y SweetAlert -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var forms = document.querySelectorAll('.needs-validation');
        
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    // event.preventDefault();
                    Swal.fire({
                        icon: 'success',
                        text: 'Evento publicado exitosamente',
                        confirmButtonText: 'Aceptar',
                        timer: 2000,                      
                    });
                    // form.reset();
                    // form.classList.remove('was-validated');
                    // var modal = bootstrap.Modal.getInstance(document.getElementById('formularioEvento'));
                    // modal.hide();
                    //LOGICA PARA CAPTURAR LOS DATOS Y GUARDAR LOS DATOS DEL FORMULARIO
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Añadir evento al botón "Cancelar"
        document.querySelector('.btn-cancelar').addEventListener('click', function () {
            Swal.fire({
                icon: 'warning',
                text: 'Evento cancelado',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                window.location.href = "{{ route('calendario.evento') }}";
            });
        });
    });
</script>
