@extends('index')

@section('reservas/ver')
<div class="container mt-3">
		<div class="card vercard">
			<h3 class="card-header">Reservas</h3>
            <div class="card-body bg-content">
                <div class ="card details-card">
                    <h3 class="card-header details-header">Detalle de reserva</h3>                                    
                    <div class="card-body bg-content">
                        <div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="table_encabezado_color">
                                        <td colspan="2">Detalle</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Nombre docente</td>
                                        <td style="width: 50%;">Leticia Blanco</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Nombre ambiente</td>
                                        <td style="width: 50%;">690 A</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Motivo de reserva</td>
                                        <td style="width: 50%;">Examen primer parcial</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Cantidad de estudiantes</td>
                                        <td style="width: 50%;">200</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Fecha</td>
                                        <td style="width: 50%;">24-04-2024</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Periodo</td>
                                        <td style="width: 50%;">9:45-12:45</td>
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
                                            <th class="col" style="width: 70%;">Materia</th>
                                            <th scope="col" style="width: 30%;">Grupo</th>
                                        </tr>
                                    </thead>
                                    @for ($i = 0; $i < $tam; $i++)
                                        @if($seleccionado[$i]->reservas_id == $idReserva)
                        
                                        <thead class="text-center">
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>{{$materias[$seleccionado[$i]->materias_id-1]->Nombre}}</td>
                                                    <td>{{$materias[$seleccionado[$i]->materias_id-1]->Grupo}}</th></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Introducción a la programación</td>
                                                    <td>2</td>
                                                </tr>
                                                <tr>
                                                    <td>Introducción a la programación</td>
                                                    <td>2</td>
                                                </tr> -->
                                            </tbody> 
                                        </thead>
                                        @endif
				                    @endfor
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection