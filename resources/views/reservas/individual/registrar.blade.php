@extends('reservas/principal')

@section('contenido-registrarIndividual')

<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="row">
            <!-- FORMULARIO -->
            <form action= "{{ route('reservas.individual.tomarMaterias') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <p class="h3" style="text-align: center;">Formulario de reserva individual - Parte 1</p>

                <div class="col">
                    <!-- campo para poner el nombre del docente -->
                    <label for="docente-name" class="col-form-label h4">Nombre docente: {{auth()->user()->name}}</label>
                </div>
                <div class="col">
                    <!-- campo para mostrar la lista de materias del docente -->
                    <label for="materia-name" class="col-form-label h4">Materia:</label>
                    <div class="input-group">
                        <select name="materia" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                            <option value="" disabled selected>Seleccione materia</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="1">One</option>
                        </select>
                            <button id="btn-buscar" type="submit" class="btn btn-secondary custom-btn">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- TABLA MATERIAS IMPARTIDAS POR EL DOCENTE-->
        <form id="tabla-form" action= "" method="POST" class="needs-validation" novalidate>
            <div class="col">
                <div id="tabla" class="table-responsive margin" style="max-height: 550px; overflow-y: auto; display: block;">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="bg-custom-lista">
                            <tr>
                                <th class="text-center h4 text-white">Grupo</th>
                                <th class="text-center h4 text-white">Inscritos</th>
                                <th class="text-center h4 text-white">Selección</th>
                            </tr>
                        </thead>
                        {{-- cuerpo --}}
                        <tbody>
                                        <!-- Fila Ploma -->
                                        <thead class="bg-custom-lista-fila-plomo">	
                                            <tr>
                                                <th class="text-center h4 text-black">2</th>
                                                <th class="text-center h4 text-black">90</th>
                                                <th class="text-center h4 text-black">
                                                    <div class="d-flex justify-content-center">
                                                        <div>
                                                            <input class="form-check-input" type="checkbox" name="options[]" value="">
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <!-- Fila blanca -->
                                        <thead class="bg-custom-lista-fila-blanco">
                                            <tr>
                                                <th class="text-center h4 text-black">3</th>
                                                <th class="text-center h4 text-black">150</th>
                                                <th class="text-center h4 text-black">
                                                    <div class="d-flex justify-content-center">
                                                        <div>
                                                            <input class="form-check-input" type="checkbox" name="options[]" value="">
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>	
                                        </thead>
                        </tbody>
                    </table>
                    <!-- BOTON SIGUIENTE DE LA TABLA -->
                    <button id="btn-siguiente"  type="submit" class="btn btn-primary custom-btn" >Siguiente</button>
                </div> 
            </div>
        </form>
    </div>
</div>            

<script>
   
    // Agregar un event listener para el botón de búsqueda
    document.getElementById('btn-buscar').addEventListener('click', function() {
    // Mostrar la tabla y el botón de siguiente después de un breve retraso
        document.getElementById('tabla').style.display = 'block';
        //document.getElementById('btn-siguiente').style.display = 'block';
           
    });
    
</script>

@endsection