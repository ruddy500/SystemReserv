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
                            <label for="titulo-anuncio" class="form-label">Titulo:</label>
                            <input type="text" class="form-control" id="titulo-anuncio" required>
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>
                        <!-- CAMPO CONTENIDO ANUNCIO -->
                        <div class="mb-3">
                            <label for="contenido-anuncio-text" class="form-label">Contenido:</label>
                            <textarea class="form-control" name="contenido-anuncio" id="contenido-anuncio-text" required></textarea>
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <!-- Botón Publicar con SweetAlert2 -->
                            <button type="submit" class="btn btn-aceptar" id="btn-publicar">Publicar</button>
                            <!-- Botón Cancelar con SweetAlert2 -->
                            <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Ejecución de la validación cuando se intente enviar el formulario
(function () {
    'use strict'
    // Obtener todos los formularios a los que queremos aplicar estilos de validación personalizados
    var forms = document.querySelectorAll('.needs-validation')
    
    // Bucle sobre los formularios y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()  // Prevenir el envío del formulario
                    // Mostrar alerta de éxito con SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Aviso publicado exitosamente',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        // // Resetear el formulario y cerrar el modal después de mostrar la alerta
                        // form.reset()
                        // form.classList.remove('was-validated')
                        // var modal = bootstrap.Modal.getInstance(document.getElementById('formularioAnuncio'))
                        // modal.hide()
                        //ruta donde redirigira el formulario
                    })
                }
            }, false)
        })
})()

// Alerta de SweetAlert2 para el botón Cancelar
document.getElementById('btn-cancelar').addEventListener('click', function() {
    Swal.fire({
        icon: 'warning',
        title: 'Aviso cancelado',
        confirmButtonText: 'Aceptar'
    })
})
</script>