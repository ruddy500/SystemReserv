@extends('reservas/principal')

@section('contenido-registrar')

<div class="card-body bg-content">
    <div class="mb-3">
        <!-- Tabla que se mostrará cuando se seleccione una fecha -->
        <label for="materia-name" class="col-form-label h4">Materia:</label>
        <div id="tabla" class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
            <table class="table table-striped table-hover table-bordered">
                <thead class="bg-custom-lista">
                    <tr>
                        <th class="text-center h4 text-white">Nombre</th>
                        <th class="text-center h4 text-white">Grupo</th>
                        <th class="text-center h4 text-white">Selección</th>
                    </tr>
                </thead>
                
                <form id="reservasForm" action="{{ route('reservas.guardar') }}" method="post">
                @csrf
                
                @for ($i = 0; $i < $tam; $i++)
                    @if($materias_docentes[$i]->docentes_id == auth()->user()->id)
                        @if ($i % 2 == 0)
                        <!-- Fila Ploma -->
                        <thead class="bg-custom-lista-fila-plomo">	
                            <tr>
                                <th class="text-center h4 text-black">{{$materias[$materias_docentes[$i]->materias_id-1]->Nombre}}</th>
                                <th class="text-center h4 text-black">{{$materias[$materias_docentes[$i]->materias_id-1]->Grupo}}</th>
                                <th class="text-center h4 text-black">
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel{{$i}}" name="options[]" value="{{$materias[$materias_docentes[$i]->materias_id-1]->Grupo}}" aria-label="...">
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
                                <th class="text-center h4 text-black">
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel{{$i}}" name="options[]" value="{{$materias[$materias_docentes[$i]->materias_id-1]->id}}" aria-label="...">

                                        <input type="hidden" name="usuario" value="{{auth()->user()->id}}">
                                        </div>
                                    </div>
                                </th>
                            </tr>	
                        </thead>
                        @endif
                    @endif
				@endfor
            </form> 
            </table>
            {{-- <a href="{{ route('reservas.formFinal') }}" class="btn btn-primary custom-btn" id="btn-siguiente" >Siguiente</a> --}}
            <a href="#" id="btn-siguiente" class="btn btn-primary custom-btn">Siguiente</a>
                
                <!-- Script para enviar el formulario al hacer clic en el enlace -->
                {{-- <script>
                    document.getElementById('btn-siguiente').addEventListener('click', function(event) {
                        event.preventDefault(); // Evitar que el enlace se comporte como un enlace normal
                        document.getElementById('reservasForm').submit(); // Enviar el formulario manualmente
                    });
                </script> --}}

                <!-- Script para enviar el formulario y redirigir al hacer clic en el enlace "Siguiente" -->
            <script>
                document.getElementById('btn-siguiente').addEventListener('click', function(event) {
                    event.preventDefault(); // Evitar que el enlace se comporte como un enlace normal
                    
                    // Envía el formulario manualmente
                    document.getElementById('reservasForm').submit(); 
                    
                    // Redirigir al usuario a la ruta especificada por 'reservas.formFinal'
                    // window.location.href = "{{ route('reservas.formFinal') }}";
                });
            </script>
        </div>
    </div>
</div>
@endsection