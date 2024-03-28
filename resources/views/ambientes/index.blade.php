@extends('index')

@section('ambientes')
	<div class="container mt-3">
			<div class="card">
				<h3 class="card-header">Ambientes</h3>
				<div class="card-body bg-custom">
					<button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#formularioAmbiente" data-bs-whatever="@mdo"><i class="bi bi-plus-circle-fill"></i>  Registrar ambiente</button>
					@include('ambientes.ambiente.registrar')

					<div class="table-responsive">
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<tr>
									<th class="text-center h4">Habilitar</th>
									<!--<th class="text-center">Nombre de usuario</th>-->
									<th class="text-center h4">Nombre de ambiente</th>
									<th class="text-center h4">Capacidad</th>
									<th class="text-center h4">Opciones</th>
								</tr>
							</thead>						
						</table>
					</div>
					
				</div>
			</div>
    </div>
@endsection