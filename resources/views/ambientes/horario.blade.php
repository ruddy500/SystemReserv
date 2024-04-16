@extends('index')

@section('ambientes/horario')
<!--{ { dd(get_defined_vars())}} -->
<?php 
//use App\Models\Dias;
use App\Models\Fechas;
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
                        lo enviará junto con el formulario cuando se envíe.Si pongo esto tengo que obligar a enviar ese dato-->
                    
                         <input type="hidden" name="ambiente" value="{{ $ambiente->id }}">
                    <div class="row">
                        <div class="col">
                            <label for="horario-name" class="col-form-label h4">Horario:</label>
                            <select id="horario-select" name="periodos[]" class="selectpicker custom-select form-control btn-lg" multiple="true" data-size="5" data-actions-box="true" data-show-deselect-all="false" title="Seleccione horario" required>
                                <!-- Captura los periodos -->
                                @foreach ($periodos as $periodo)
                                <option value= "{{ $periodo->id }}"> {{ $periodo->HoraIntervalo }} </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- CAMPO DE FECHA CON CALENDARIO -->
                        <label for="fecha-name" class="col-form-label h4">Fecha:</label>
                        <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                            <input name="fecha" class="form-control" type="text" readonly />
                            <span class="input-group-addon"></span>
                        </div>
                        
                    </div>
                    <div class="col-auto">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-horario margin-end" data-bs-target="#" data-bs-whatever="@mdo">Añadir</button>
                        </div>
                    </div>
                @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                @endif

                @if(session('message'))
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            text: '{{ session('message') }}',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                @endif
                </form>


                <!-- PRUEBA DE TABLA DE HORARIOS DISPONIBLES -->
                <div>
                <label for="tablehorario-name" class="col-form-label h4">Horarios disponibles:</label>
                <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                    <table id="horario-tabla" class="table caption-top">
                        <thead class="text-center">
                            <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Horario</th>
                            <th scope="col">Estado</th>
                            </tr>
                        </thead>
                         <!-- recorre el horario capturado y vamos obteniendo sus ids de fecha y 
                              de periodo , luego buscamos su equivalencia -->

                         @foreach ($horario as $fila)
                                @php
           
                                    // $diaId = $fila->dias_id;
                                    // $dia = Dias::find($diaId)->Dia;
                                    $fechaId = $fila->fechas_id;
                                    $fechaD = Fechas::find($fechaId)->dia;
                                    $fechaM = Fechas::find($fechaId)->mes;
                                    $fechaY = Fechas::find($fechaId)->anio;
                                    if($fechaD < 10){
                                        $fechaD = "0".$fechaD;
                                    }
                                    
                                    if($fechaM < 10){
                                        $fechaM = "0".$fechaM;
                                    }
                                    $fechaCompleta = $fechaD."-".$fechaM."-".$fechaY;


                                    $periodoId = $fila->periodos_id;
                                    $periodo = Periodos::find($periodoId)->HoraIntervalo;

                                    
                                    
                                    $estado = ($fila->Estado) ? "Libre" : "Ocupado";
                                @endphp

                                <tbody class="text-center">
                                    <tr>
                                    {{-- <td>{{ $dia }}</td> --}}
                                    <td>{{ $fechaCompleta }}</td>
                                    <td>{{ $periodo }}</td>
                                    <td>{{ $estado }}</td>
                                    </tr>
                                </tbody>
                                    
                         @endforeach
                        
                    </table>
                </div>

                </div>
            
            </div>
        </div>
</div>
@endsection