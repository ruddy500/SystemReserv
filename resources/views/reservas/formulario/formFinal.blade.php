@extends('reservas/principal')

@section('contenido-registrar')
<div class="card-body bg-content">
    <div class="mb-3">
        <form class="row g-3 needs-validation" action="{{ route('reservas.guardarReserva') }}" method="post" novalidate>
            @csrf
            {{-- <form class="row g-3 needs-validation" novalidate> --}}
            <div class="mb-3">
                <label for="cantidad-name" class="col-form-label h4">Cantidad de estudiantes:</label>
                <input type="number" name="cantidad" class="form-control" id="cantidad-name" minlength="3" maxlength="100" min="30" max="200" required>
                <div class="invalid-feedback">
                    Inserte un rango entre 30 a 200 de cantidad
                </div>
            </div>

            <div class="mb-3">
                <label for="motivo-text" class="col-form-label h4">Motivo:</label>

                <textarea class="form-control" name="motivo" id="motivo-text" required minlength="5" maxlength="200"></textarea>

                <div class="invalid-feedback">
                    Inserte un motivo entre 5 a 50 caracteres
                </div>
            </div>

            <input type="hidden" name="usuario" value="{{auth()->user()->id}}"> {{-- aqui se enviara id del usuario --}}

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
                    // Si el formulario es válido, enviar el formulario
                    form.submit();
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
                backdrop: true,
                allowOutsideClick: false // Asegura que el SweetAlert2 se muestre hasta que el usuario haga clic en "Aceptar"
            }).then((result) => {
                // Si el usuario hace clic en "Aceptar", redirige al usuario a otra vista
                if (result.isConfirmed) {
                    window.location.href = '{{ route("reservas.cancelarReserva") }}'; //  ruta a la que quieres redirigir al usuario
                }
            });
        });

        //mostrar modal y
        @if(session('success'))
        Swal.fire({
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            backdrop: true,
            allowOutsideClick: false // Asegura que el SweetAlert2 se muestre hasta que el usuario haga clic en "Aceptar"
        }).then((result) => {
            // Si el usuario hace clic en "Aceptar", redirige al usuario a la ruta '/reservas'
            if (result.isConfirmed) {
                window.location.href = '/reservas';
            }
        });
        @endif
    })();

</script>

{{-- <script>
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
                        backdrop: true,
                        allowOutsideClick: false // Asegura que el SweetAlert2 se muestre hasta que el usuario haga clic en "Aceptar"
                    }).then((result) => {
                        // Si el usuario hace clic en "Aceptar", redirige al usuario a otra vista
                        if (result.isConfirmed) {
                            window.location.href = '/reservas'; // ruta a la que quieres redirigir al usuario
                        }
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
                backdrop: true,
                allowOutsideClick: false // Asegura que el SweetAlert2 se muestre hasta que el usuario haga clic en "Aceptar"
            }).then((result) => {
                        // Si el usuario hace clic en "Aceptar", redirige al usuario a otra vista
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("reservas.cancelarReserva") }}'; //  ruta a la que quieres redirigir al usuario
                        }
                    });;
        });
    })();
</> --}}
@endsection
