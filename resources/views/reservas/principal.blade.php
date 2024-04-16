@extends('index')

@section('reservas/principal')
<div class="container mt-3">
	<div class="card">
		<h3 class="card-header">Reservas</h3>
		<div class="card-body bg-custom">
            <div class="bs-component">
		        <div class="panel-body">
					<div class="row">
						<div class="col-md-4 col-md-offset-8 text-center">
							<div class="btn-group btn-group-raised">
							  <a href="{{ route('reservas.asignadasDocente') }}" class="btn btn-primary custom-btn">Asignadas</a>
							  <span class="divider"></span> <!-- Línea blanca --> 
							  <a href="{{ route('reservas.pendientesDocente') }}" class="btn btn-primary custom-btn">Pendientes</a>
                              <span class="divider"></span> <!-- Línea blanca --> 
							  <a href="{{ route('reservas.registrar') }}" class="btn btn-primary custom-btn btn-reserva" >Registrar reserva</a>
							</div>
						</div>
					</div>
                    @yield('contenido-asignadas')
					@yield('contenido-pendientes')
					@yield('contenido-registrar')
	            </div>
        	</div>
        </div>
    </div>
</div>
@endsection