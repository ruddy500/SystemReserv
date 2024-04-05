@extends('index')

@section('ambientes/ver')
<div class="container mt-3">
		<div class="card vercard">
			<h3 class="card-header">Ambiente {{$nombre->nombreambiente->Nombre}}</h3>
            <div class="card-body bg-content">
                <div class ="card details-card">
                    <h4 class="card-header details-header">Detalle de ambiente</h3>
                    <h1>Nombre de Ambiente {{$nombre->nombreambiente->Nombre}}</h1>                        
                    <h1>Capacidad {{$nombre->Capacidad}}</h1>                        
                    <h1>Descripcion: {{$nombre->Ubicacion}}</h1>                        
                    
                    <div class="card-body bg-content">
                    </div>
                </div>
            </div>
        </div>
</div>        


@endsection@