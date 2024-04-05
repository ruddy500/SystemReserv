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
                            <select name="ambiente" class="form-control" required>
                                <option value="" disabled selected >Selecciona una aula</option>
                               <!-- me captura todo los ambientes -->
                                @foreach($nombreambientes as $nombreambiente)
                                <option value="{{ $nombreambiente->id }}"> {{ $nombreambiente->Nombre }} </option>
                                @endforeach 
                            </select>
                        </div> 
                        <div class="mb-3">
                            <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>
                            <input type="number" name= "capacidad" class="form-control" id="capacidad-name" required minlength="3" maxlength="100" min="30" max="200">
                            <div class="valid-feedback">Capacidad válida</div>
                            <div class="invalid-feedback">Inserte un rango entre 30 a 200 de capacidad</div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                            <textarea class="form-control" name = "descripcion" id="descripcion-ubicacion-text" required minlength="10" maxlength="50"></textarea>
                            <div class="valid-feedback">Descripcion válida</div>
                            <div class="invalid-feedback">Inserte una descripcion entre 10 a 50 caracteres</div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                </div>
                
                @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            text: '{{ session('success') }}',
                        });
                    </script>
                @endif

                @if(session('message'))
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            text: '{{ session('message') }}',
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ session('error') }}',
                        });
                    </script>
                @endif

                @if ($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de validación',
                            html: "{!! implode('<br>', $errors->all()) !!}",
                        });
                    </script>
                @endif


            </form>
        </div>
    </div>
</div>


