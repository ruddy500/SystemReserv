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
    function enviarFormulario() {
    // Previene el comportamiento predeterminado del formulario
    event.preventDefault();

    // Muestra la alerta de éxito
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: 'Ambientes registrados exitosamente',
        allowOutsideClick: false, // Evita que la alerta se cierre al hacer clic fuera de ella
        showCancelButton: false, // Oculta el botón de cancelar
        confirmButtonText: 'Aceptar' // Texto del botón de confirmación
    }).then((result) => {
        // Envía el formulario de manera asíncrona y redirige al usuario a la misma vista una vez que hagan clic en "OK"
        if (result.isConfirmed) {
            var form = document.getElementById('formulario-ambientes');
            var formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.ok) {
                    window.location.href = '/ambientes'; // Reemplaza 'tu_url_aqui' con la URL de tu vista
                } else {
                    // Maneja el error
                    console.error('Error:', response);
                }
            }).catch(error => console.error('Error:', error));
        }
    });
}

</script>
