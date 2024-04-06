@extends('index')

@section('ambientes/ver')
<div class="container mt-3">
		<div class="card vercard">
			<h3 class="card-header">Ambiente {{$nombre->nombreambiente->Nombre}}</h3>
            <div class="card-body bg-content">
                <div class ="card details-card">
                    <h4 class="card-header details-header">Detalle de ambiente</h3>                                    
                    <div class="card-body bg-content">
                        <div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="table_encabezado_color">
                                        <td colspan="2">Detalle</td>
                                    </tr>
                                    <tr>
                                        <td>Nombre de Ambiente</td>
                                        <td>{{$nombre->nombreambiente->Nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Capacidad</td>
                                        <td>{{$nombre->Capacidad}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Descripción:
                                            <br>
                                            {{$nombre->Ubicacion}}
                                        </td>
                                    </tr>
                                </tbody>                        
                            </table>
                            
                        <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                            <table id="horario-tabla" class="table caption-top">
                                <thead class="table_encabezado_color text-center">
                                    <td colspan="3">Horarios</td>
                                </thead>    
                            <thead class="text-center">
                                <tr>
                                    <th class="col">Día</th>
                                    <th scope="col">Horario</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>

                            <thead class="text-center">
                                <tr>
                                    <td>Lunes</td>
                                    <td>15:45</td>
                                    <td>Libre</td>
                                </tr>
                                
                                <tr>
                                    <td>Lunes</td>
                                    <td>15:45</td>
                                    <td>Libre</td>
                                </tr>
                            
                                <tr>
                                    <td>Lunes</td>
                                    <td>15:45</td>
                                    <td>Libre</td>
                                </tr>
                                
                            </thead>
                        </table>

                        </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>        


@endsection