<!-- Modal -->
<div class="modal fade" id="formularioReglas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Reglas de Ambientes </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="formulario-reglas" method="POST" action="{{ url('/guardar-regla') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf <!-- Agregar el token CSRF -->
                        @include('componentes.validacion')
                        <!-- CAMPO TITULO DE ANUNCIO -->
                        <div class="mb-3">
                            <label for="titulo-reglas" class="form-label">Regla #1:</label>
                            <input type="text" class="form-control" name="regla-1" id="regla-1" required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio.
                            </div>
                        </div>
                        <!-- Sección para agregar reglas dinámicamente -->
                        <div id="reglas-container"></div>
                        <button type="button" class="btn btn-light" id="btn-agregar-regla"  style="margin-bottom:20px;">Agregar Regla</button>
                        
                        <input type="hidden" name="tam" id="tam" readonly>
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

<style>
    .btn-eliminar-regla {
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 50rem;
    }

    .btn-eliminar-regla:hover {
        background-color: darkred;
    }

    .form-control {
        border-radius: 0.25rem;
    }
    .input-group textarea {
        border-radius: 2.25rem;
        height: 10px; /* Tamaño normal */
    }

    .input-group .form-control, .input-group .btn-eliminar-regla {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }
    .regla-label {
        width: 100%;
        margin-bottom: 0.5rem;
    }
</style>

<script>
    let reglaCounter = 2; // Contador de reglas
    let tamanio = document.getElementById('tam');
    tamanio.value = 1;
    document.getElementById('btn-agregar-regla').addEventListener('click', function() {
        agregarRegla();
        tamanio.value = reglaCounter-1;
    });


    function agregarRegla() {
        // Crear un nuevo div para la regla
        const nuevaReglaDiv = document.createElement('div');
        nuevaReglaDiv.classList.add('mb-3', 'regla-item', 'input-group');
        nuevaReglaDiv.setAttribute('id', `regla-${reglaCounter}-container`);

        // Crear el label para la nueva regla
        const nuevaReglaLabel = document.createElement('label');
        nuevaReglaLabel.classList.add('form-label', 'regla-label');
        nuevaReglaLabel.setAttribute('for', `regla-${reglaCounter}`);
        nuevaReglaLabel.innerText = `Regla #${reglaCounter}:`;

        // Crear el textarea para la nueva regla
        const nuevaReglaTextarea = document.createElement('textarea');
        nuevaReglaTextarea.classList.add('form-control');
        nuevaReglaTextarea.setAttribute('name', `regla-${reglaCounter}`);
        nuevaReglaTextarea.setAttribute('id', `regla-${reglaCounter}`);
        nuevaReglaTextarea.setAttribute('aria-label', 'With textarea');
        nuevaReglaTextarea.required = true;

        // Crear el botón de eliminar
        const btnEliminar = document.createElement('button');
        btnEliminar.type = 'button';
        btnEliminar.classList.add('btn-eliminar-regla', 'input-group-text');
        btnEliminar.innerText = '-';
        btnEliminar.setAttribute('onclick', `eliminarRegla('regla-${reglaCounter}-container')`);

        // Crear el feedback de validación para la nueva regla
        const nuevaReglaFeedback = document.createElement('div');
        nuevaReglaFeedback.classList.add('invalid-feedback');
        nuevaReglaFeedback.innerText = 'Este campo es obligatorio.';

        // Añadir el label, textarea, feedback y botón de eliminar al div de la nueva regla
        nuevaReglaDiv.appendChild(nuevaReglaLabel);
        nuevaReglaDiv.appendChild(nuevaReglaTextarea);
        nuevaReglaDiv.appendChild(btnEliminar);
        nuevaReglaDiv.appendChild(nuevaReglaFeedback);

        // Añadir el div de la nueva regla al contenedor de reglas
        document.getElementById('reglas-container').appendChild(nuevaReglaDiv);

        // Incrementar el contador de reglas
        reglaCounter++;
    }

    function eliminarRegla(reglaId) {
        const reglaDiv = document.getElementById(reglaId);
        reglaDiv.remove();
        actualizarNumerosReglas();
    }

    function actualizarNumerosReglas() {
        const reglas = document.querySelectorAll('.regla-item');
        reglaCounter = 2;
        reglas.forEach(regla => {
            const label = regla.querySelector('.regla-label');
            label.innerText = `Regla #${reglaCounter}:`;
            reglaCounter++;
        });
        tamanio.value = tamanio.value-1;
    }
</script>