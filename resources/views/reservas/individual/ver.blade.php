@extends('index')

@section('reservas/verIndividual')

<div class="container mt-3">
	<div class="card vercard">
		<h3 class="card-header">Reservas</h3>
        <div class="card-body bg-content">
            
            <div class ="card details-card">
                <h3 class="card-header details-header">Reserva {{$reservas[$idReserva-1]->Tipo}}</h3>                                    
                <div class="card-body bg-content">
                    <div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="table_encabezado_color">
                                    <td colspan="2">Detalle</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Nombre docente</td>
                                    <td style="width: 50%;">{{auth()->user()->name}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Cantidad de estudiantes</td>
                                    <td style="width: 50%;">{{$reservas[$idReserva-1]->CantEstudiante}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Motivo de reserva</td>
                                    <td style="width: 50%;">{{$motivo[$reservas[$idReserva-1]->motivos_id-1]->Nombre}}</td>
                                </tr>  
                                <tr>
                                    <td style="width: 50%;">Fecha</td>
                                    <td style="width: 50%;">//</tr>
                                <tr>
                                    <td style="width: 50%;">Periodo</td>
                                    <td style="width: 50%;">06:45 - 09:45</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- TABLA DE DETALLE DE RESERVA -->
                        <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                            
                            <table id="horario-tabla" class="table caption-top table-bordered ">
                                <thead class="table_encabezado_color text-center">
                                    <td colspan="3">Detalle de materia</td>
                                    <thead class="text-center">
                                        <tr>
                                            <th class="col" style="width: 50%;">Materia</th>
                                            <th scope="col" style="width: 25%;">Grupo</th>
                                            <th scope="col" style="width: 25%;">Inscritos</th>
                                        </tr>
                                    </thead>
                                    <thead class="text-center">
                                    @for($i=0;$i<$tam;$i++)
                                        <tbody class="text-center">
                                            @if($seleccionadas[$i]->reservas_id==$idReserva)
                                            <tr>
                                                <td>{{$materias[$seleccionadas[$i]->materias_id-1]->Nombre}}</td>
                                                <td>{{$materias[$seleccionadas[$i]->materias_id-1]->Grupo}}</td>
                                                <td>{{$materias[$seleccionadas[$i]->materias_id-1]->Inscritos}}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                        @endfor 
                                    </thead>
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