@extends('index')

@section('ambientes')
	<div class="container mt-3">
			<div class="card">
				<h3 class="card-header">Ambientes</h3>
				<div class="card-body bg-custom">
					<button type="button" class="btn btn-custom margin" data-bs-toggle="modal" data-bs-target="#formularioAmbiente" data-bs-whatever="@mdo"><i class="bi bi-plus-circle-fill"></i>  Registrar ambiente</button>
					@include('ambientes.ambiente.registrar')
					@include('componentes.validacion')

					<div class="table-responsive margin">
						<table class="table table-striped table-hover table-bordered">
							<thead class="bg-custom-lista">
								<tr>
									<th class="text-center h4 text-white">Habilitar</th>
									<th class="text-center h4 text-white">Nombre de ambiente</th>
									<th class="text-center h4 text-white">Capacidad</th>
									<th class="text-center h4 text-white">Opciones</th>
								</tr>
							</thead>						
						</table>
					</div>
					
				</div>
			</div>
    </div>
@endsection