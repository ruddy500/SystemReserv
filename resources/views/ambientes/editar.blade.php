@extends('index')


@section('ambientes/editar')
<!--{ { dd(get_defined_vars()) }} -->
<?php 
use App\Models\Dias;
use App\Models\Periodos; // Assuming you need Periodos model
$horario = $ambiente->horarios()->get();
?>

<div class="container mt-3">
        <div class="card">
            <h3 class="card-header">Editar ambiente</h3>
            <div class="card-body bg-custom">
            <form action="{{ route('ambientes.actualizar', $ambiente->id) }}" method="POST" novalidate class="row g-3 needs-validation">
            @csrf

            @method('PUT')
            @include('componentes.validacion')
           
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="ambiente-name" class="col-form-label h4">Ambiente:</label>
                            <select name="ambiente" class="form-control form-select-sm h4" aria-label="Small select example" required disabled>
                               
                                <!-- Aqui recoger el dato de nombre de ambiente -->
                                <option value="" disabled selected>{{$ambiente->nombreambiente()->first()->Nombre}}</option>
                            </select>


                           


                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="capacidad-name" class="col-form-label h4">Capacidad:</label>      
                            <input type="number" name= "capacidad" class="form-control" id="capacidad-name" required value="{{$ambiente->Capacidad}}" required minlength="3" maxlength="100" min="30" max="200">
                            <div class="valid-feedback">Capacidad válida</div>
                            <div class="invalid-feedback">Inserte un rango entre 30 a 200 de capacidad</div>


                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion-ubiacion-text" class="col-form-label h4">Descripción de ubicación:</label>
                                                                                                                                                   
                    <textarea class="form-control" name = "descripcion" id="descripcion-ubicacion-text" required>{{ $ambiente->Ubicacion }}</textarea>
                    <div class="valid-feedback">Descripcion válida</div>
                    <div class="invalid-feedback">Inserte una descripcion entre 10 a 50 caracteres</div>


                </div>


                <!-- Otras partes del formulario ... -->
                 {{-- esta parte del formulario no tiene funcionalidad, falta q se actualice el horario --}}


                <label for="tablehorario-name" class="col-form-label h4">Horarios disponibles:</label>
                <table id="horario-tabla" class="table caption-top">
                    <thead>
                        <tr>
                        <th scope="col">Habilitar</th>
                        <th scope="col">Día</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($horario as $fila)
                        <?php
       
                            $diaId = $fila->dias_id;
                            $dia = Dias::find($diaId)->Dia;

                            $periodoId = $fila->periodos_id;
                            $periodo = Periodos::find($periodoId)->HoraIntervalo;
                            
                        ?>

                        <tr data-bs-toggle="modal" data-bs-target="#formularioHorario" data-bs-whatever="@mdo">
                            @include('ambientes.ambiente.editHorario')
                                
                                <td>
                                    <div class="text-center">
                                        <div class="form-check form-switch d-inline-block align-middle">        
                                                <!--aqui se añade el boton swith segun su estado-->
                                                @if ($fila->Estado)
                                                <input class="form-check-input" type="checkbox" role="switch" name="habilitado" id="habilitado_{{$fila->id}}" data-id="{{$fila->periodos_id}}-{{ $ambiente->id }}-{{ $diaId }}" onchange="cambiarEstado(this)" checked>
                                                @else
                                                <input class="form-check-input" type="checkbox" role="switch" name="habilitado" id="habilitado_{{$fila->id}}" data-id="{{$fila->periodos_id}}-{{ $ambiente->id }}-{{ $diaId }}" onchange="cambiarEstado(this)">
                                                @endif
                                            
                                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $dia }}</td>
                                <td>{{ $periodo }}</td>
                                <td>
                                    <div class="circle3">
                                        <a href="#" class="btn btn-fab" title="Editar">
                                            <i class="fas fa-edit" style="color: white;"></i>  
                                        </a>
                                    </div>
                                </td>
                        </tr>
                                    
                        @endforeach
                        

                    </tbody>
                </table> 
                <div class="horario-footer">
                    <button type="submit" class="btn btn-aceptar">Aceptar</button>
                    <button type="button" class="btn btn-cancelar" onclick="window.history.back();">Cancelar</button>
                   
                    {{-- <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button> --}}
                </div>
                </div>
            </form>
            </div>
        </div>
</div>


<!--Para cambiar el estado de mi atributo Estado de horario -->
<script>
    function cambiarEstado(checkbox) {
var isChecked = checkbox.checked;
// Obtener el valor del atributo data-id
var ambienteId = checkbox.getAttribute("data-id");
// Dividir la cadena en partes usando el delimitador "-"
var partes = ambienteId.split("-");

var horarioId = partes[0];
var ambienteId = partes[1];
var diaId = partes[2];

fetch('/ambientes/editar/'+horarioId+'/'+ambienteId+'/'+diaId+'/cambiar-estado', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
        estado: isChecked
    })
})
.then(response => response.json())
.then(data => {
    console.log(data);
})
.catch(error => {
    console.error('Error:', error);
});
}

</script>
    

@endsection
