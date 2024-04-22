<div class="modal fade" id="formularioEditReserva" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content edith-reserva">
            {{-- <form class="row g-3 needs-validation" action="#" method="POST" novalidate> --}}
<form class="row g-3 needs-validation" action="{{ route('reservas.actualizar',$idReserva) }}" method="POST" novalidate>
    @method('PUT') 

                {{-- <form action="{{ route('actualizar.reserva') }}" method="POST"    {{ route('ambientes.actualizar', $ambiente->id) }}>
                    @csrf
                    @method('PUT') --}}

                <div class="modal-header">
                    <h3 class="modal-title h3">Formulario edición de reserva</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-start">
                        <label for="ambiente-name" class="form-label h4">Ambiente:</label>
                        <select name="ambiente" class="form-select" aria-label="Small select example" value="hola" required disabled>
                            <option value="" disabled selected>{{ $ambiente->nombreambiente()->first()->Nombre }}</option>
                           
                        </select>

                        {{-- <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                        <select name="ambiente" class="form-control form-select-sm h4" aria-label="Small select example" required disabled>
                            <!-- Aquí recoge el dato de nombre de ambiente -->
                            <option value="" disabled selected>{{ $ambiente->nombreambiente()->first()->Nombre }}</option>
                        </select> --}}


                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="cantidad-name" class="form-label h4">Cantidad estudiantes:</label>
                        <input type="number" name="cantidad" class="form-control" id="cantidad-name" required minlength="3" maxlength="100" min="30" max="200">
                        <div class="invalid-feedback">
                            Inserte un rango entre 30 a 200 de cantidad
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="motivo-text" class="form-label h4">Motivo:</label>
                        <textarea class="form-control" name="motivo" id="motivo-text" required minlength="5" maxlength="100"></textarea>
                        <div class="invalid-feedback">
                            Inserte un motivo entre 5 a 50 caracteres
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-aceptar" id="aceptar">Aceptar</button>
                    <button type="button" class="btn btn-cancelar" id="cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            document.getElementById('aceptar').addEventListener('click', function (event) {
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
                            window.location.href = '/reservas/pendientesDocente'; // ruta a la que quieres redirigir al usuario
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
                            window.location.href = '/reservas'; //  ruta a la que quieres redirigir al usuario
                        }
                    });;
        });
    })();
</script>
