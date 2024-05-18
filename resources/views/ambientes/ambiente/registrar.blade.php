<div class="modal fade" id="formularioAmbiente" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="row g-3 needs-validation" action="{{ route('guardar.ambiente') }}" method="POST" novalidate>
                @csrf
                <!--'@'method('PUT') xd -->
                <div class="modal-header">
                    <h3 class="modal-title h3">Formulario de ambiente</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                            <select name="ambiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                <option value="" disabled selected >Seleccione aula</option>
                               <!-- me captura todo los ambientes -->
                                
                               @foreach($nombreambientes as $nombreambiente)
                                    <option value="{{ $nombreambiente->id }}"> {{ $nombreambiente->Nombre }} </option>
                                @endforeach

                            </select>
                        </div> 
                        <div class="mb-3">
                            <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>
                            <input type="number" name= "capacidad" class="form-control" id="capacidad-name" required minlength="3" maxlength="100" min="10" max="300">
                            <div class="valid-feedback">Capacidad válida</div>
                            <div class="invalid-feedback">Inserte un rango entre 10 a 300 de capacidad</div>
                        </div>
                        
                        <!-- CAMPO TIPO DE AMBIENTE AÑADIDO -->
                        <div class="mb-3">
                            <label for="tipo-ambiente-name" class="col-form-label h4">Tipo de ambiente:</label>
                            <select name="tipoAmbiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                <option value="" disabled selected >Seleccione tipo de ambiente</option>
                                  <!-- me captura los tipos de ambientes -->
                                  
                                  @foreach($tipoambientes as $tipoambiente)
                                    <option value="{{ $tipoambiente->id }}"> {{ $tipoambiente->Nombre }} </option>
                                  @endforeach 

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion-ubicacion-text" required minlength="10" maxlength="50" ></textarea>
                            <div class="invalid-feedback">Inserte una descripción entre 10 a 50 caracteres</div>
                            
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button id="cancelar" type="button" class="btn btn-cancelar" >Cancelar</button>
                </div>
                
                @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                @endif

                @if(session('message'))
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            text: '{{ session('message') }}',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ session('error') }}',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                @endif

                @if ($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de validación',
                            html: "{!! implode('<br>', $errors->all()) !!}",
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                @endif

            </form>
        </div>
    </div>
</div>

<script>
    $('#cancelar').on('click', function() {
        Swal.fire({
            title: "Cancelado",
            icon: "warning",
            confirmButtonColor: "#7066e0",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/ambientes';
            }
        });
    });
</script>

<!-- <script>
    // Obtener el textarea
    const descripcionTextarea = document.getElementById('descripcion-ubicacion-text');
    const validFeedback = document.getElementById('valid-feedback');

    // Agregar un evento de escucha para cuando cambie el contenido
    descripcionTextarea.addEventListener('input', function() {
        // Obtener el valor del textarea
        const descripcionValue = descripcionTextarea.value;

        // Expresión regular para validar letras y espacios
        const regex = /^[a-zA-Z\s]*$/;

        // Verificar si el valor cumple con la expresión regular
        if (regex.test(descripcionValue)) {
            // Si es válido, mostrar el mensaje de validación
            descripcionTextarea.setCustomValidity('');
            descripcionTextarea.classList.remove('is-invalid');
            descripcionTextarea.classList.add('is-valid');
            validFeedback.style.display = 'block'; // Mostrar el mensaje de validación
        } else {
            // Si no es válido, mostrar el mensaje de error
            descripcionTextarea.setCustomValidity(' ');
            descripcionTextarea.classList.remove('is-valid');
            descripcionTextarea.classList.add('is-invalid');
            validFeedback.style.display = 'none'; // Ocultar el mensaje de validación
        }
    });
</script> -->
