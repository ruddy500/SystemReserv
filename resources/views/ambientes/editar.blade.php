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
            <form class="row g-3 needs-validation" action="" method="POST" novalidate>
            @csrf
            <input type="hidden" name="ambiente" value="{{ $ambiente->id }}">
            
            @include('componentes.validacion')
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
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
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>
                            <input type="number" name= "capacidad" class="form-control" id="capacidad-name" required minlength="3" maxlength="100" min="30" max="200">
                            <div class="valid-feedback">Capacidad válida</div>
                            <div class="invalid-feedback">Inserte un rango entre 30 a 200 de capacidad</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                    <textarea class="form-control" name = "descripcion" id="descripcion-ubicacion-text" required></textarea>
                    <div class="valid-feedback">Descripcion válida</div>
                    <div class="invalid-feedback">Inserte una descripcion entre 10 a 50 caracteres</div>
                </div>
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

                             $periodoId = $fila->periodos_id;
                             $periodo = Periodos::find($periodoId)->HoraIntervalo;
                             
                         @endphp

                    <tr data-bs-toggle="modal" data-bs-target="#formularioHorario" data-bs-whatever="@mdo">
                        @include('ambientes.ambiente.editHorario')
                           
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