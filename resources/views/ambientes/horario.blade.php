@extends('index')

@section('ambientes/horario')
<!--{ { dd(get_defined_vars())}} -->
<?php 
use App\Models\Dias;
use App\Models\Periodos; // Assuming you need Periodos model

$horario = $ambiente->horarios()->get();
?>


<div class="container mt-3">
		<div class="card">
			<h3 class="card-header">Formulario registro de horario</h3>
            <div class="card-body bg-custom">
                <form class="row g-3 needs-validation" action="{{ route('ambientes.horario.añadir') }}" method="POST" novalidate>
                    @csrf
                    @include('componentes.validacion')
                    <!-- Este campo oculto capturará el ID del ambiente y 
<<<<<<< HEAD
                        lo enviará junto con el formulario cuando se envíe.-->
                    {{-- <input type="hidden" name="ambiente" value="{{ $ambienteId  }}"> --}}
=======
                        lo enviará junto con el formulario cuando se envíe.Si pongo esto tengo que obligar a enviar ese dato-->
>>>>>>> cd50250e37d4ad6656e5c163abeb87d9f091cc85
                    
                         <input type="hidden" name="ambiente" value="{{ $ambiente->id }}">
                    <div class="row">
                        <div class="col">
                            <label for="dia-name" class="col-form-label h4">Día:</label>
                            <select name="dia" class="selectpicker custom-select form-control btn-lg" title="Seleccione día" required>
                               <!--captura los dias-->
                                @foreach ($dias as $dia)
                                <option value="{{ $dia->id }}"> {{ $dia->Dia }} </option>
                                @endforeach
                               
                            </select>
                        </div>
                        <div class="col">
                            <label for="horario-name" class="col-form-label h4">Horario:</label>
                            <select id="horario-select" name="periodos[]" class="selectpicker custom-select form-control btn-lg" multiple="true" data-size="5" data-actions-box="true" data-show-deselect-all="false" title="Seleccione horario" required>
                                <!-- Captura los periodos -->
                                @foreach ($periodos as $periodo)
                                <option value= "{{ $periodo->id }}"> {{ $periodo->HoraIntervalo }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-horario margin-end" data-bs-target="#" data-bs-whatever="@mdo">Añadir</button>
                        </div>
                    </div>
                </form>

<<<<<<< HEAD
=======

                <!-- PRUEBA DE TABLA DE HORARIOS DISPONIBLES -->
                <div>
                <label for="tablehorario-name" class="col-form-label h4">Horarios disponibles:</label>
                <div class="table-responsive" style="max-height: 180px; overflow-y: auto;">
                    <table id="horario-tabla" class="table caption-top">
                        <thead>
                            <tr>
                            <th scope="col">Dia</th>
                            <th scope="col">Horario</th>
                            <th scope="col">Estado</th>
                            </tr>
                        </thead>
                         <!-- recorre el horario capturado y vamos obteniendo sus ids de dia y 
                              de periodo , luego buscamos su equivalencia -->

                         @foreach ($horario as $fila)
                                @php
           
                                    $diaId = $fila->dias_id;
                                    $dia = Dias::find($diaId)->Dia;

                                    $periodoId = $fila->periodos_id;
                                    $periodo = Periodos::find($periodoId)->HoraIntervalo;
                                    
                                    $estado = ($fila->Estado) ? "Libre" : "Ocupado";
                                @endphp

                                <tbody >
                                    <tr>
                                    <td>{{ $dia }}</td>
                                    <td>{{ $periodo }}</td>
                                    <td>{{ $estado }}</td>
                                    </tr>
                                </tbody>
                                    
                         @endforeach
                        
                    </table>
                </div>

                </div>
>>>>>>> cd50250e37d4ad6656e5c163abeb87d9f091cc85
            
            </div>
        </div>
</div>
@endsection