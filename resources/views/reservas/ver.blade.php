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
                            <table id="horario-tabla" class="table caption-top">
                                <thead class="table_encabezado_color text-center">
                                    <td colspan="3">Detalle de materia</td>
                                    <thead class="text-center">
                                        <tr>
                                            <th class="col">Materia</th>
                                            <th scope="col">Grupo</th>
                                        </tr>
                                    </thead>
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection