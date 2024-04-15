@extends('index')

@section('reservas/admin/principal')
<div class="container mt-3">
	<div class="card">
		<h3 class="card-header">Reservas</h3>
		<div class="card-body bg-custom">
            <div class="bs-component">
		        <div class="panel-body">
					<div class="row">
						<div class="col-md-4 col-md-offset-8 text-center">
							<div class="btn-group btn-group-raised">
							  <a href="{{ route('reservas.asignadas') }}" class="btn btn-primary custom-btn">Asignadas</a>
							  <span class="divider"></span> <!-- Línea blanca --> 
							  <a href="{{ route('reservas.pendientes') }}" class="btn btn-primary custom-btn">Pendientes</a>
							</div>
						</div>
					</div>
					@yield('contenido-asignadas')
                    @yield('contenido-pendientes')
	            </div>
        	</div>
        </div>
    </div>
</div>
@endsection