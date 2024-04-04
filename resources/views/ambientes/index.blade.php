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
							<!-- me muestra todos los ambientes tiene que estar en un foreach-->

							<!--Fila Ploma-->
							<thead class="bg-custom-lista-ambientes-plomo">
								@foreach($ambientes as $ambiente)
								<tr>
									<th class="text-center h4 text-black">
										<div class="text-center">
											<div class="form-check form-switch d-inline-block align-middle">
												<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
												<label class="form-check-label" for="flexSwitchCheckChecked"></label>
											</div>
										</div>
									</th>
									
									<th class="text-center h4 text-black">{{$ambiente->nombreambiente->Nombre}}</th>
									
									
									<th class="text-center h4 text-black">{{$ambiente->Capacidad}}</th>
									
									<th class="text-center h4 text-black">
										<div class="d-flex justify-content-center">
											<div class="circle">
												<i class="fas fa-calendar-alt" style="color: white;"></i>
											</div>

											<div class="circle2">
												<i class="bi bi-box-arrow-up-right" style="color: white;"></i>
											</div>

											<div class="circle3">
												<i class="fas fa-edit" style="color: white;"></i>
											</div>
										</div>
									</th>
								</tr>
								@endforeach
							</thead>
							
							<!--Fila Blanca-->
							<thead class="bg-custom-lista-ambientes-blanco">
								<tr>
									<th class="text-center h4 text-black">
										<div class="text-center">
											<div class="form-check form-switch d-inline-block align-middle">
												<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
												<label class="form-check-label" for="flexSwitchCheckChecked"></label>
											</div>
										</div>
									</th>

									<th class="text-center h4 text-black">Auditorio 1</th>

									<th class="text-center h4 text-black">150</th>

									<th class="text-center h4 text-black">
										<div class="d-flex justify-content-center">
											<div class="circle">
												<i class="fas fa-calendar-alt" style="color: white;"></i>
											</div>

											<div class="circle2">
												<i class="bi bi-box-arrow-up-right" style="color: white;"></i>
											</div>

											<div class="circle3">
												<i class="fas fa-edit" style="color: white;"></i>
											</div>
										</div>
									</th>
								</tr>
							</thead>
						</table>
					</div>
					
				</div>
			</div>
    </div>
@endsection