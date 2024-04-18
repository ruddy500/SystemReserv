@extends('reservas/principal')

@section('contenido-registrar')
<div class="card-body bg-content">
    <div class="mb-3">
        <form class="row g-3 needs-validation" novalidate>
            <div class="mb-3">
                <label for="cantidad-name" class="col-form-label h4">Cantidad de estudiantes:</label>
                <input type="number" name="cantidad" class="form-control" id="cantidad-name" minlength="3" maxlength="100" min="30" max="200" required>
                <div class="invalid-feedback">
                    Inserte un rango entre 30 a 200 de cantidad
                </div>
            </div>

            <div class="mb-3">
                <label for="motivo-text" class="col-form-label h4">Motivo:</label>
                <textarea class="form-control" name="motivo" id="motivo-text" required minlength="5" maxlength="50"></textarea>
                <div class="invalid-feedback">
                    Inserte un motivo entre 5 a 50 caracteres
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-aceptar">Aceptar</button>
                <button id="cancelar" type="button" class="btn btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    (function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    // Si el formulario es válido, mostrar SweetAlert2
                    event.preventDefault(); // Agrega esta línea
                    Swal.fire({
                        text: 'Solicitud de reserva registrada Exitosamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        backdrop: true
                    });
                }

                form.classList.add('was-validated');
            }, false);
        });

        // Agrega un evento de clic al botón "Cancelar"
        document.getElementById('cancelar').addEventListener('click', function() {
            Swal.fire({
                text: 'Cancelado',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
                backdrop: true
            });
        });
    })();
</script>
@endsection
