@extends('reservas/principal')

@section('contenido-registrarGrupal')
{{-- {{ dd(get_defined_vars()) }}  --}}
<?php
    use App\Models\DocentesMaterias;
    use App\Models\Materias;
    use App\Models\Usuarios;

    $idDocente = auth()->user()->id;
    $nombreDocente = auth()->user()->name ;                
    $docenteMaterias = DocentesMaterias::where('docentes_id',$idDocente)->get();

    $materiasSinRep = [];

    // Filtrar los registros para obtener solo los materias_id con nombres diferentes
    $i = 0;
    foreach ($docenteMaterias as $docenteMateria) {
        $materiaId = $docenteMateria->materias_id;
        $nombreMateria = Materias::find($materiaId)->Nombre; // Suponiendo que tengas un modelo Materia con una columna 'nombre'

        // Verificar si el nombre de la materia ya está en el array
        if (!in_array($nombreMateria, $materiasSinRep)) {
            // Si no está, agregarlo al array
            $materiasSinRep[$i] = $nombreMateria;
            $i++;
        }
    }

    $tamMaterias = count($materiasSinRep);
?>

<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="row">
            <!-- FORMULARIO -->
            <form id="formulario" action= "{{ route('reservas.grupal.consultarMaterias') }}" method="POST">
                @csrf
                <div class="col">
                    <!-- campo para poner el nombre del docente que está haciendo la reserva-->
                    <label for="docente-name" class="col-form-label h4">Nombre docente: {{ $nombreDocente }}</label>
                </div>
                <div class="col">
                    <!-- seleccionable de materias de un docente en específico -->
                    <div class="mb-3">
                        <label for="materia-name" class="col-form-label h4">Materia:</label>
                        <div class="input-group">
                            <select name="materia" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                <option value="" disabled selected>Seleccione materia</option>
                                {{-- materias del docente --}}
                                @for ($i = 0; $i < $tamMaterias; $i++)
                                    <?php
                                        $nombreMateria = $materiasSinRep[$i]; 
                                    ?>  
                                    <option value="{{ $nombreMateria }}" {{ $nombreMateria == old('materia') ? 'selected' : '' }}>{{ $nombreMateria }}</option>            
                                @endfor
                            </select>
                            <div class="input-group-append">
                                <button id="btn-buscar" type="submit" class="btn btn-primary custom-btn"><i class="bi bi-search"></i> Buscar</button>
                            </div>
                        
                    </div>
                </div>
            </form>
        </div>
      
<!-- TABLA MATERIAS IMPARTIDAS POR OTROS DOCENTES -->
        <form id="tabla-form" action= "{{ route('reservas.grupal.tomarMaterias') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            @if (session()->get('materias'))
            <?php 
                //capturo las materias que me envia mi controlador consultar materias a esta vista
                $materias = session()->get('materias');
                $tamMateCap = count($materias);
            ?>
            
            <div class="col">
                <div id="tabla" class="table-responsive margin" style="max-height: 550px; overflow-y: auto; display: block;">
                    <table class="table table-striped table-hover table-bordered">
                       
                        <thead class="bg-custom-lista">
                            <tr>
                                <th class="text-center h4 text-white">Nombre docente</th>
                                <th class="text-center h4 text-white">Grupo</th>
                                <th class="text-center h4 text-white">Inscritos</th>
                                <th class="text-center h4 text-white">Selección</th>
                            </tr>
                        </thead>
                       {{-- cuerpo --}}
                        <tbody>

                            @for ( $i=0 ; $i < $tamMateCap; $i++)
                                <?php
                                
                                    $docenteMateria = DocentesMaterias::where('materias_id',$materias[$i]->id)->first();
                                    $idDocente = $docenteMateria->docentes_id;
                                    //dd($idDocente);

                                    $docenteEncontrado = Usuarios::where('id',$idDocente)->first();
                                    $nombreDocente = $docenteEncontrado->name;

                                    $materiaGrupo = $materias[$i]->Grupo;
                                    $materiaInscritos = $materias[$i]->Inscritos;
                                ?>
                                @if ($i % 2 == 0)
                                    <!-- Fila blanca -->
                                    <thead class="bg-custom-lista-fila-blanco">
                                        <tr>
                                            
                                            <th class="text-center h4 text-black">{{ $nombreDocente }}</th>
                                            <th class="text-center h4 text-black">{{ $materiaGrupo }}</th>
                                            <th class="text-center h4 text-black">{{ $materiaInscritos }}</th>
                                            <th class="text-center h4 text-black">
                                                <div class="d-flex justify-content-center">
                                                    <div>
                                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="{{ $materias[$i]->id }}" aria-label="...">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>    
                                    </thead>
 
                                @else
                                    <!-- Fila plomo -->
                                    <thead class="bg-custom-lista-fila-plomo">
                                        <tr>
                                            
                                            <th class="text-center h4 text-black">{{ $nombreDocente }}</th>
                                            <th class="text-center h4 text-black">{{ $materiaGrupo }}</th>
                                            <th class="text-center h4 text-black">{{ $materiaInscritos }}</th>
                                            <th class="text-center h4 text-black">
                                                <div class="d-flex justify-content-center">
                                                    <div>
                                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="options[]" value="{{ $materias[$i]->id }}" aria-label="...">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>    
                                    </thead>
                                @endif
                                                               
                               
                            @endfor
                            
                            
                        </tbody>
                    </table>
                    
                </div>
              <!-- BOTON SIGUIENTE DE LA TABLA -->
              <button id="btn-siguiente"  type="submit" class="btn btn-primary custom-btn" >Siguiente</button>
                    
            </div>
        
            @endif
            
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

{{-- ayuda a buscar --}}
{{-- <script> 
    // Obtener el elemento select
    var selectMateria = document.querySelector('select[name="materia"]');

    // Agregar un event listener para detectar cambios en la selección
    selectMateria.addEventListener('change', function() {
        // Obtener el formulario
        var formulario = document.getElementById('formulario');

        // Enviar el formulario automáticamente al cambiar la selección
        formulario.submit();
    });
</script> --}}

<script>
    document.getElementById('btn-siguiente').addEventListener('click', function(event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);

        if (!checkedOne) {
            Swal.fire({
                icon: 'warning',
                title: 'Error...',
                text: 'Debes seleccionar al menos una materia!',
                confirmButtonText: 'Aceptar',
                
            });
            event.preventDefault();
        } else {
            // Redirigir al usuario a la ruta especificada por 'reservas.formFinalIndividual'
            window.location.href = "{{ route('reservas.formFinalGrupal') }}";
        }
    });
</script>


@endsection
