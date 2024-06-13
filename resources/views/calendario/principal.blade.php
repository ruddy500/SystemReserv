@extends('index')


@section('calendario/principal')
{{-- {{ dd(get_defined_vars()) }} --}}
<div class="container mt-3">
	<div class="card  vercard">
		<h3 class="card-header">Calendario</h3>
		<div class="card-body">
            <div class="bs-component">
		        <div class="panel-body">
					<div class="row">
						<!-- cambien de 3 a 4 -->
						<div class="col-md-3 col-md-offset-8 text-center">
							<div class="btn-group btn-group-raised custom-btn-group">
								<a href="{{ route('calendario.inicio') }}" class="btn btn-primary custom-btn borde">Inicio</a>
								<a href="{{ route('calendario.evento') }}" class="btn btn-primary custom-btn borde">Evento</a>
                                <a href="{{ route('calendario.configuracion') }}" class="btn btn-primary custom-btn borde">Configuración</a>
							</div> 
						</div>
					</div>
                    @yield('contenido-inicio')
					@yield('contenido-evento')
					@yield('contenido-configuracion')
	            </div>
        	</div>
        </div>
    </div>
</div>
@endsection