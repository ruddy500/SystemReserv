@extends('index')

@section('inicio')
	<div class="container mt-3">
			<div class="card">
				<h3 class="card-header">Ambientes</h3>
				<div class="card-body bg-custom">
					<button type="button" class="btn btn-custom margin" data-bs-toggle="modal" data-bs-target="#formularioAmbiente" data-bs-whatever="@mdo">
						<i class="bi bi-plus-circle-fill"></i>  Registrar ambiente
					</button>
					
				</div>
			</div>
    </div>
@endsection