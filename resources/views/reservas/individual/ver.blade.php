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
                                    <td style="width: 50%;">{{$docente}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Cantidad de estudiantes</td>
                                    <td style="width: 50%;">{{$reserva->CantEstudiante}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Motivo de reserva</td>
                                    <td style="width: 50%;">{{$motivoReserva}}</td>
                                </tr>  
                                <tr>
                                    <td style="width: 50%;">Fecha</td>
                                    <td style="width: 50%;">{{$reserva->fecha}}</td>
                                </tr> 
                                <tr>
                                    <td style="width: 50%;">Periodo</td>
                                    
                                    @php
                                        $incremento = 0;
                                    @endphp

                                    @for($i = 0; $i < $tamP; $i++)
                                        @if($incremento == 0)
                                            @if($periodos[$i]->reservas_id == $idReserva)
                                                @php
                                                    $incremento = $incremento + 1;
                                                @endphp
                                                <td id='borrar' style="width: 50%;">{{$periodo[$periodos[$i]->periodos_id - 1]->HoraIntervalo}}</td>
                                            @endif
                                        @else
                                            @if($periodos[$i]->reservas_id == $idReserva)
                                                @php
                                                    $incremento = $incremento + 1;
                                                    $periodo1 = $periodo[$periodos[$i - 1]->periodos_id - 1]->HoraIntervalo;
                                                    $periodo2 = $periodo[$periodos[$i]->periodos_id - 1]->HoraIntervalo;
                                                    
                                                    $partes_P1 = explode('-', $periodo1);
                                                    $partes_P2 = explode('-', $periodo2);
                                        
                                                    $inicio = trim(str_replace(' ', '', $partes_P1[0]));
                                                    $fin = trim(str_replace(' ', '', $partes_P2[1]));
                                                @endphp
                                                <td style="width: 50%;">{{$inicio}} - {{$fin}}</td>
                                                @if($incremento > 0)
                                                    <script>
                                                        // Eliminar el elemento con id 'borrar' después de que $incremento sea mayor que cero
                                                        var elementoABorrar = document.getElementById('borrar');
                                                        elementoABorrar.parentNode.removeChild(elementoABorrar);
                                                    </script>
                                                @endif
                                            @endif
                                        @endif
                                    @endfor
                                    
                                    <!-- <td style="width: 50%;">06:45 - 09:45 me falta periodo</td> -->
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