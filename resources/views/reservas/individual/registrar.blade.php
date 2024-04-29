@extends('reservas/principal')

@section('contenido-registrarIndividual')
<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <div class="row">
            <!-- FORMULARIO -->
            <form action= "{{ route('reservas.individual.tomarMaterias') }}" method="POST" class="needs-validation" novalidate>
            @csrf
                <div class="col">
                    <!-- campo para poner el nombre del docente -->
                    <label for="docente-name" class="col-form-label h4">Nombre docente: {{auth()->user()->name}}</label>
                </div>
                <div class="col">
                    <!-- campo para mostrar la lista de materias del docente -->
                    <label for="materia-name" class="col-form-label h4">Materia:</label>
                    <div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                      
                    <table class="table table-striped table-hover table-bordered">
                            <thead class="bg-custom-lista">
                                <tr>
                                    <th class="text-center h4 text-white">Nombre</th>
                                    <th class="text-center h4 text-white">Grupo</th>
                                    <th class="text-center h4 text-white">Inscritos</th>
                                    <th class="text-center h4 text-white">Selección</th>
                                </tr>
                            </thead>
                            
                            @for ($i = 0; $i < $tam; $i++)
                                @if($materias_docentes[$i]->docentes_id == auth()->user()->id)
                                    @if ($i % 2 == 0)
                                    <!-- Fila Ploma -->
                                    <thead class="bg-custom-lista-fila-plomo">	
                                        <tr>
                                            <th class="text-center h4 text-black">{{$materias[$materias_docentes[$i]->materias_id-1]->Nombre}}</th>
                                            <th class="text-center h4 text-black">{{$materias[$materias_docentes[$i]->materias_id-1]->Grupo}}</th></th>
                                            <th class="text-center h4 text-black">{{$materias[$materias_docentes[$i]->materias_id-1]->Inscritos}}</th>
                                            <th class="text-center h4 text-black">
                                                <div class="d-flex justify-content-center">
                                                    <div>
                                                        <input class="form-check-input" type="checkbox" name="options[]" value="{{$materias[$materias_docentes[$i]->materias_id-1]->id}}">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    @else
                                    <!-- Fila blanca -->
                                    <thead class="bg-custom-lista-fila-blanco">
                                        <tr>
                                            <th class="text-center h4 text-black">{{$materias[$materias_docentes[$i]->materias_id-1]->Nombre}}</th>
                                            <th class="text-center h4 text-black">{{$materias[$materias_docentes[$i]->materias_id-1]->Grupo}}</th>
                                            <th class="text-center h4 text-black">{{$materias[$materias_docentes[$i]->materias_id-1]->Inscritos}}</th>
                                            <th class="text-center h4 text-black">
                                                <div class="d-flex justify-content-center">
                                                    <div>
                                                        <input class="form-check-input" type="checkbox" name="options[]" value="{{$materias[$materias_docentes[$i]->materias_id-1]->id}}">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>	
                                    </thead>
                                    @endif
                                @endif
                            @endfor
                                
                            
                        </table>
                        <button type="submit" id="btn-siguiente" class="btn btn-primary custom-btn">Siguiente</button>
                        </form>            
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
                                    // Envía el formulario manualmente
                                    //document.getElementById('reservasFormIndividual').submit(); 

                                    // Redirigir al usuario a la ruta especificada por 'reservas.formFinalIndividual'
                                    window.location.href = "{{ route('reservas.formFinalIndividual') }}";
                                }
                            });
                        </script>
                    </div>
                </div>
            

        </div>
    </div>
</div>
@endsection