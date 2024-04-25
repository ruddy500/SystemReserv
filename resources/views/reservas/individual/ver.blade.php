@extends('index')

@section('reservas/verIndividual')
<div class="container mt-3">
	<div class="card vercard">
		<h3 class="card-header">Reservas</h3>
        <div class="card-body bg-content">
            <div class ="card details-card">
                <h3 class="card-header details-header">Reserva individual</h3>                                    
                <div class="card-body bg-content">
                    <div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="table_encabezado_color">
                                    <td colspan="2">Detalle</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Nombre docente</td>
                                    <td style="width: 50%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Cantidad de estudiantes</td>
                                    <td style="width: 50%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Motivo de reserva</td>
                                    <td style="width: 50%;"></td>
                                </tr>  
                                <tr>
                                    <td style="width: 50%;">Fecha</td>
                                    <td style="width: 50%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Periodo</td>
                                    <td style="width: 50%;"></td>
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
                                        <tbody class="text-center">
                                            <tr>
                                                <td>Elementos de programacion</td>
                                                <td>2</td>
                                                <td>150</td>
                                            </tr>
                                            <tr>
                                                <td>Introduccion a la programacion</td>
                                                <td>3</td>
                                                <td>80</td>
                                            </tr>
                                        </tbody> 
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