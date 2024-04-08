@extends('index')

@section('ambientes/editar')
<!--{ { dd(get_defined_vars())}} -->
<?php 
use App\Models\Dias;
use App\Models\Periodos; // Assuming you need Periodos model

$horario = $ambiente->horarios()->get();
?>


<div class="container mt-3">
		<div class="card">
			<h3 class="card-header">Editar ambiente</h3>
            <div class="card-body bg-custom">
            <form action="{{ route('ambientes.actualizar', $idAmbiente->id) }}" method="POST" novalidate class="row g-3 needs-validation">
            @csrf
<<<<<<< HEAD
            @method('PUT')
=======
            <input type="hidden" name="ambiente" value="{{ $ambiente->id }}">
            
>>>>>>> cd50250e37d4ad6656e5c163abeb87d9f091cc85
            @include('componentes.validacion')
            
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
<<<<<<< HEAD
                            <select name="ambiente" class="form-control form-select-sm h4" aria-label="Small select example" required disabled>
                                
                                <!-- Aqui recoger el dato de nombre de ambiente -->
                                <option value="" disabled selected>{{$idAmbiente->nombreambiente->Nombre}}</option> 
                            </select>

                            

=======
                            <select name="ambiente" class="selectpicker custom-select form-control btn-lg" aria-label="Small select example" required>
                                <option value="" disabled selected >Seleccione aula</option>
                                <!-- Aqui recoger el dato de nombre de ambiente -->
                                <option value="" >Poner nombre ambiente 1</option>
                                <option value="" >Poner nombre ambiente 2</option>
                                <option value="" >Poner nombre ambiente 3</option>
                                <option value="" >Poner nombre ambiente 4</option>
                                <option value="" >Poner nombre ambiente 5</option>
                                <option value="" >Poner nombre ambiente 6</option>
                                <option value="" >Poner nombre ambiente 7</option>
                            </select>
>>>>>>> cd50250e37d4ad6656e5c163abeb87d9f091cc85
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>       
                            <input type="number" name= "capacidad" class="form-control" id="capacidad-name" required value="{{$idAmbiente->Capacidad}}" required minlength="3" maxlength="100" min="30" max="200">
                            <div class="valid-feedback">Capacidad válida</div>
                            <div class="invalid-feedback">Inserte un rango entre 30 a 200 de capacidad</div>

                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                                                                                                                                                   
                    <textarea class="form-control" name = "descripcion" id="descripcion-ubicacion-text" required>{{ $idAmbiente->Ubicacion }}</textarea>
                    <div class="valid-feedback">Descripcion válida</div>
                    <div class="invalid-feedback">Inserte una descripcion entre 10 a 50 caracteres</div>

                </div>
<<<<<<< HEAD

                <!-- Otras partes del formulario ... -->
                 {{-- esta parte del formulario no tiene funcionalidad, falta q se actualice el horario --}}

                {{-- <label for="tablehorario-name" class="col-form-label h4">Horarios disponibles:</label>
                <table id="horario-tabla" class="table caption-top">
                    <thead>
                        <tr>
                        <th scope="col">Habilitar</th>
                        <th scope="col">Día</th>
                        <th scope="col">Horario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-bs-toggle="modal" data-bs-target="#formularioHorario" data-bs-whatever="@mdo">
                        @include('ambientes.ambiente.editHorario')
                            <td>poner switch</td>
                            <td>Lunes</td>
                            <td>06:45-08:15</td>
                        </tr>
=======
                <label for="tablehorario-name" class="col-form-label h4">Horarios disponibles:</label>
                
                <div class="table-responsive" style="max-height: 160px; overflow-y: auto;">
                    <table id="horario-tabla" class="table caption-top">
                        <thead>
                            <tr>
                            <th scope="col">Habilitar</th>
                            <th scope="col">Día</th>
                            <th scope="col">Horario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Recorrer con un for-->
                           
                         @foreach ($horario as $fila)
                         @php
    
                             $diaId = $fila->dias_id;
                             $dia = Dias::find($diaId)->Dia;
>>>>>>> cd50250e37d4ad6656e5c163abeb87d9f091cc85

                             $periodoId = $fila->periodos_id;
                             $periodo = Periodos::find($periodoId)->HoraIntervalo;
                             
                         @endphp

                    <tr data-bs-toggle="modal" data-bs-target="#formularioHorario" data-bs-whatever="@mdo">
                        @include('ambientes.ambiente.editHorario')
<<<<<<< HEAD
                            <td>poner switch</td>
                            <td>Lunes</td>
                            <td>15:45-17:15</td>
                        </tr>
                    </tbody>
                </table> --}}
                <div class="horario-footer">
                    <button type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button type="button" class="btn btn-cancelar" onclick="window.history.back();">Cancelar</button>
                    
                    {{-- <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button> --}}
                </div>
=======
                           
                            <td>
                                <div class="text-center">
                                    <div class="form-check form-switch d-inline-block align-middle">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                    </div>
                                </div>
                            </td>

                            <td>{{ $dia }}</td>
                            <td>{{ $periodo }}</td>
                    </tr>



                             
                  @endforeach
                 
                        </tbody>
                    </table>
                </div>
                <div class="horario-footer">
                    <button type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button id="cancelar" type="button" class="btn btn-cancelar">Cancelar</button>
>>>>>>> cd50250e37d4ad6656e5c163abeb87d9f091cc85
                </div>
            </form>
            </div>
        </div>
</div>
<script>
    $('#cancelar').on('click', function() {
        Swal.fire({
        title: "¿Estas Seguro que deseas Salir?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar" ,
        cancelButtonText: "Cancelar",
        allowOutsideClick: false
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/ambientes';
        }
        });
    });
</script>

@endsection