@extends('index')

@section('ambientes')
<!--{ { dd(get_defined_vars())}}-->
<?php
	use App\Models\Dias;
?>

	<div class="container mt-3">
			<div class="card">
				<h3 class="card-header">Ambientes</h3>
				<div class="card-body bg-custom">
					<button type="button" class="btn btn-custom margin" data-bs-toggle="modal" data-bs-target="#formularioAmbiente" data-bs-whatever="@mdo"><i class="bi bi-plus-circle-fill"></i>  Registrar ambiente</button>
					@include('ambientes.ambiente.registrar')
					@include('componentes.validacion')

					<div class="table-responsive margin" style="max-height: 250px; overflow-y: auto;">
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
                            @for ($i = 0; $i < $tamAmbientes ; $i++)

								@if ($i % 2 == 0)
								<!--Fila Ploma-->
								
								<thead class="bg-custom-lista-ambientes-plomo">
									<tr>
										<th class="text-center h4 text-black">
											<div class="text-center">
												<div class="form-check form-switch d-inline-block align-middle">
													<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked"></label>
												</div>
											</div>
										</th>
                                        <th class="text-center h4 text-black">{{$ambientes[$i]->nombreambiente->Nombre}}</th>
										<th class="text-center h4 text-black">{{$ambientes[$i]->Capacidad}}</th>
										
										<th class="text-center h4 text-black">
											<div class="d-flex justify-content-center">
												
												<div class="circle"><!--añadi id-->
													<a href="{{ route('ambientes.horario', ['ambiente' => $ambientes[$i]->id]) }}" class="btn btn-fab" title="Horario"> 
														<i class="fas fa-calendar-alt" style="color: white;"></i>	
													</a>
												</div>

												<div class="circle2"> <!--modifique nombre-->
													<a href="{{ route('ambientes.ver',['ambiente' => $ambientes[$i]->id ]) }}" class="btn btn-fab" title="Ver"> 
														<i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
													</a>
												</div>

												<div class="circle3"><!--añadi parametro ambiente-->
													<a href="{{ route('ambientes.editar',['ambiente' => $ambientes[$i]->id ]) }}" class="btn btn-fab" title="Editar"> 
														<i class="fas fa-edit" style="color: white;"></i>	
													</a>
												</div>
											</div>
										</th>
									</tr>
								</thead>
								
								@else
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
                                         
										<th class="text-center h4 text-black">{{$ambientes[$i]->nombreambiente->Nombre}}</th>
										<th class="text-center h4 text-black">{{$ambientes[$i]->Capacidad}}</th>
	
										<th class="text-center h4 text-black">
											<div class="d-flex justify-content-center">
											<div class="circle">
													<a href="{{ route('ambientes.horario',['ambiente' => $ambientes[$i]->id]) }}" class="btn btn-fab" title="Horario"> 
														<i class="fas fa-calendar-alt" style="color: white;"></i>	
													</a>
												</div>

												<div class="circle2">
													<a href="{{ route('ambientes.ver',['ambiente' => $ambientes[$i]->id ]) }}" class="btn btn-fab" title="Ver"> 
														<i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
													</a>
												</div>

												<div class="circle3">
													<a href="{{ route('ambientes.editar',['ambiente' => $ambientes[$i]->id ]) }}" class="btn btn-fab" title="Editar"> 
														<i class="fas fa-edit" style="color: white;"></i>	
													</a>
												</div>
											</div>
										</th>
									</tr>
								
								</thead>		
								@endif

							@endfor		
						</table>
					</div>
				</div>
			</div>
    </div>

	<script>
        $(document).ready(function() {
            // Función para recargar la página después de cerrar el modal
            $('#formularioAmbiente').on('hidden.bs.modal', function () {
                location.reload();
            });
        });
    </script>

@endsection