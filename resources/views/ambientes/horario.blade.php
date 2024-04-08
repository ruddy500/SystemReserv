@extends('index')

@section('ambientes/horario')
<div class="container mt-3">
		<div class="card">
			<h3 class="card-header">Formulario registro de horario</h3>
            <div class="card-body bg-custom">
                <form class="row g-3 needs-validation" action="{{ route('ambientes.horario.añadir') }}" method="POST" novalidate>
                    @csrf
                    @include('componentes.validacion')
                    <!-- Este campo oculto capturará el ID del ambiente y 
                        lo enviará junto con el formulario cuando se envíe.-->
                    {{-- <input type="hidden" name="ambiente" value="{{ $ambienteId  }}"> --}}
                    
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
                            <select id="horario-select" name="horario[]" class="selectpicker custom-select form-control btn-lg" multiple="true" data-size="5" data-actions-box="true" data-show-deselect-all="false" title="Seleccione horario" required>
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

            
            </div>
        </div>
</div>
@endsection