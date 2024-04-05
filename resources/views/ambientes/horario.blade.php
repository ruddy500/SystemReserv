@extends('index')

@section('ambientes/horario')
<div class="container mt-3">
		<div class="card">
			<h3 class="card-header">Formulario registro de horario</h3>
            <div class="card-body bg-custom">
                <form action="{{ route('ambientes.horario.añadir') }}" method="POST">
                    @csrf
                    <!-- Este campo oculto capturará el ID del ambiente y 
                        lo enviará junto con el formulario cuando se envíe.-->
                    <input type="hidden" name="ambiente" value="{{ $ambiente }}">
                    
                    <div class="row">
                        <div class="col">
                            <label for="dia-name" class="col-form-label h4">Día:</label>
                            <select name="dia" class="selectpicker custom-select form-control btn-lg" title="Seleccione día">
                               <!--captura los dias-->
                                @foreach ($dias as $dia)
                                <option value="{{ $dia->id }}"> {{ $dia->Dia }} </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col">
                            <label for="horario-name" class="col-form-label h4">Horario:</label>
                            <select id="horario-select" name="horario[]" class="selectpicker custom-select form-control btn-lg" multiple="true" data-size="5" data-actions-box="true" data-show-deselect-all="false" title="Seleccione horario">
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


                <!-- PRUEBA DE TABLA DE HORARIOS DISPONIBLES -->
                <label for="tablehorario-name" class="col-form-label h4">Horarios disponibles:</label>
                <table id="horario-tabla" class="table caption-top">
                    <thead>
                        <tr>
                        <th scope="col">Dia</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>Lunes</td>
                        <td>06:45-08:15</td>
                        <td>Libre</td>
                        </tr>

                        <tr>
                        <td>Lunes</td>
                        <td>15:45-17:15</td>
                        <td>Libre</td>
                        </tr>

                        <tr>
                        <td>Martes</td>
                        <td>Todos los horarios</td>
                        <td>Libre</td>
                        </tr>
                    </tbody>
                </table>
            
            </div>
        </div>
</div>
@endsection@