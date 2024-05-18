<!-- Modal -->
<div class="modal fade" id="registroAmbiente-masivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de ambientes masivo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="formulario-ambientes" action="{{route('import.excel')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @include('componentes.validacion')
                        <div class="mb-3"> 
                            <label for="banner" class="form-label">Archivo Excel:</label>
                            <input type="file" class="form-control" id="archivo-ambientes" name="file" accept=".xlsx, .xls" required>
                            <div class="valid-feedback">Archivo seleccionado</div>
                            <div class="invalid-feedback">Seleccione Archivo</div>
                            <br>
                        </div>
                    
                        <div class="modal-footer">
                            <!-- Agrega un evento onclick para mostrar la alerta de éxito -->
                            <button type="button" class="btn btn-aceptar" onclick="enviarFormulario()">Aceptar</button>
                            <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para enviar el formulario y mostrar la alerta de éxito -->
<script>
    var archivo = document.getElementById('archivo-ambientes');

    // Agrega un evento de cambio al campo del archivo
    archivo.addEventListener('change', function() {
        if (archivo.value === '') {
            archivo.classList.add('is-invalid');
            archivo.classList.remove('is-valid');
        } else {
            archivo.classList.remove('is-invalid');
            archivo.classList.add('is-valid');
        }
    });

    function enviarFormulario() {
        // Previene el comportamiento predeterminado del formulario
        event.preventDefault();

        var form = document.getElementById('formulario-ambientes');

        // Verifica si el campo del archivo está vacío
        if (archivo.value === '') {
            // Muestra un mensaje de error
            archivo.classList.add('is-invalid');
        } else {
            // Muestra la alerta de éxito
            archivo.classList.remove('is-invalid');
            archivo.classList.add('is-valid');

            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'Ambientes registrados exitosamente',
                allowOutsideClick: false,
                showCancelButton: false,
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                // Envía el formulario de manera asíncrona y redirige al usuario a la misma vista una vez que hagan clic en "OK"
                if (result.isConfirmed) {
                    var formData = new FormData(form);
                    fetch(form.action, {
                        method: 'POST',
                        body: formData
                    }).then(response => {
                        if (response.ok) {
                            window.location.href = '/ambientes';
                        } else {
                            // Maneja el error
                            console.error('Error:', response);
                        }
                    }).catch(error => console.error('Error:', error));
                }
            });
        }
    }
</script>