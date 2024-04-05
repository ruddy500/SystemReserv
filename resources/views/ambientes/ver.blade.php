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
                        <div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="table_encabezado_color">
                                        <td colspan="2">Detalle</td>
                                    </tr>
                                    <tr>
                                        <td>Nombre de Ambiente</td>
                                        <td>Auditorio</td>
                                    </tr>
                                    <tr>
                                        <td>Capacidad</td>
                                        <td>40</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Descripción:
                                            <br>
                                            aqui se muestra las descripcion del ambiente
                                        </td>
                                    </tr>
                                </tbody>                        
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>        


@endsection@