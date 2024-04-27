@extends('reservas/principal')

@section('contenido-registrarGrupal')

<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="row">
            <!-- FORMULARIO -->
            <form id="formulario" method="POST">
                <div class="col">
                    <!-- campo para poner el nombre del docente que está haciendo la reserva-->
                    <label for="docente-name" class="col-form-label h4">Nombre docente: Leticia Blanco Coca</label>
                </div>
                <div class="col">
                    <!-- seleccionable de materias de un docente en específico -->
                    <div class="mb-3">
                        <label for="materia-name" class="col-form-label h4">Materia:</label>
                        <div class="input-group">
                            <select name="materia" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                <option value="" disabled selected>Seleccione materia</option>
                                <option>Elementos de programación y estructuración de datos</option>
                                <option>Introducción a la programación</option> 
                                <option>Arquitectura de computadoras</option> 
                                <option>Taller de ingeniería de software</option>      
                            </select>
                            <!-- BOTON PARA BUSCAR DIFERENTES GRUPOS DE OTROS DOCENTES -->
                            <div class="input-group-append">
                                <button id="btn-buscar" type="button" class="btn btn-primary custom-btn"><i class="bi bi-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- TABLA MATERIAS IMPARTIDAS POR OTROS DOCENTES -->
        <form id="" action="" method="POST" class="needs-validation" novalidate>
            <div class="col">
                <div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto; display: none;">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="bg-custom-lista">
                            <tr>
                                <th class="text-center h4 text-white">Nombre docente</th>
                                <th class="text-center h4 text-white">Grupo</th>
                                <th class="text-center h4 text-white">Inscritos</th>
                                <th class="text-center h4 text-white">Selección</th>
                            </tr>
                        </thead>
                        <form id="reservasFormIndividual" action="" method="post">
                            <!-- Fila Plomo -->
                            <thead class="bg-custom-lista-fila-plomo">    
                                <tr>
                                    <th class="text-center h4 text-black">Leticia Blanco Coca</th>
                                    <th class="text-center h4 text-black">2</th>
                                    <th class="text-center h4 text-black">110</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <!-- Fila blanca -->
                            <thead class="bg-custom-lista-fila-blanco">
                                <tr>
                                    <th class="text-center h4 text-black">Carla Zalasar Serrudo</th>
                                    <th class="text-center h4 text-black">3</th>
                                    <th class="text-center h4 text-black">80</th>
                                    <th class="text-center h4 text-black">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="" aria-label="...">
                                            </div>
                                        </div>
                                    </th>
                                </tr>    
                            </thead>
                        </form>
                    </table>
                    <!-- BOTON SIGUIENTE DE LA TABLA -->
                    <button id="btn-siguiente" class="btn btn-primary custom-btn" style="display: none;">Siguiente</button>
                    <script>
                        document.getElementById('btn-siguiente').addEventListener('click', function(event) {
                            event.preventDefault(); // Evitar que el enlace se comporte como un enlace normal
                                
                            // Envía el formulario manualmente
                            //document.getElementById('reservasForm').submit(); 
                                
                            // Redirigir al usuario a la ruta especificada por 'reservas.formFinal'
                            //window.location.href = "{{ route('reservas.formFinalGrupal') }}";
                        });
                    </script>
                    <script>
                            document.getElementById('btn-siguiente').addEventListener('click', function(event) {
                                event.preventDefault();

                                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);

                                if (!checkedOne) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Error...',
                                        text: 'Debes seleccionar al menos una materia!',
                                        confirmButtonText: 'Aceptar',
                                    });
                                } else {
                                    // Envía el formulario manualmente
                                    //document.getElementById('reservasFormIndividual').submit(); 

                                    // Redirigir al usuario a la ruta especificada por 'reservas.formFinalIndividual'
                                    window.location.href = "{{ route('reservas.formFinalIndividual') }}";
                                }
                            });
                    </script>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('btn-buscar').addEventListener('click', function() {
        document.getElementById('tabla').style.display = 'block';
        document.getElementById('btn-siguiente').style.display = 'block';
    });
</script>
@endsection
