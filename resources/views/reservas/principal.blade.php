@extends('index')
{{-- {{ dd(get_defined_vars()) }}  --}}
@section('reservas/principal')
<div class="container mt-3">
	<div class="card">
		<h3 class="card-header">Reservas</h3>
		<div class="card-body bg-custom">
            <div class="bs-component">
		        <div class="panel-body">
					<div class="row">
						<div class="col-md-4 col-md-offset-8 text-center">
							<div class="btn-group btn-group-raised custom-btn-group">
								<a href="{{ route('reservas.asignadasDocente') }}" class="btn btn-primary custom-btn borde">Asignadas</a>
								<a href="{{ route('reservas.pendientesDocente') }}" class="btn btn-primary custom-btn borde">Pendientes</a>
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-primary dropdown-toggle custom-btn" data-bs-toggle="dropdown" aria-expanded="false">
										Registrar reserva
									</button>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ route('reservas.registrarIndividual') }}">Individual</a></li>
										<li><a class="dropdown-item" href="{{ route('reservas.registrarGrupal') }}">Grupal</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
                    @yield('contenido-asignadas')
					@yield('contenido-pendientes')
					@yield('contenido-registrarIndividual')
					@yield('contenido-registrarGrupal')
	            </div>
        	</div>
        </div>
    </div>
</div>
@endsection