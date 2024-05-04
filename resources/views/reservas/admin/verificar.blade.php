@extends('index')

@section('reservas/verificar')
<div class="container mt-3">
	<div class="card vercard">
		<h3 class="card-header">Verificación de reserva</h3>
        <div class="card-body bg-content">
            <!-- TABLA DE DETALLE DE RESERVA -->
            <div class = "datos-reserva">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">Cantidad de estudiantes</td>
                            <td style="width: 50%;">{{$reserva->CantEstudiante}}</td>
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
                        </tr>
                    </tbody>
                </table>
                <div class="buscar" style="text-align: right;">
                    <button id="btn-buscarAmbiente" type="submit" class="btn btn-primary custom-btn"><i class="bi bi-search"></i> Buscar</button>
                </div>
            </div>
            <!-- TABLA DE AMBIENTES DISPONIBLES QUE CUMPLEN CON LOS REQUISITOS-->
            <form id="tabla-ambientesdisponibles" action= ""  method="POST">
                <div id= "tabla" class="table-responsive" style="max-height: 300px; overflow-y: auto; padding-top: 15px; display: none;">
                    <table id="horario-tabla" class="table caption-top table-bordered ">
                        <thead class="table_encabezado_color text-center">
                            <td colspan="5">Detalle de materia</td>
                            <thead class="text-center">
                                <tr>
                                    <th class="col" style="width: 20;">Nombre ambiente</th>
                                    <th scope="col" style="width: 20%;">Capacidad</th>
                                    <th scope="col" style="width: 20%;">Fecha</th>
                                    <th scope="col" style="width: 20%;">Periodo</th>
                                    <th scope="col" style="width: 20%;">Opciones</th>
                                </tr>
                            </thead>
                        </thead>
                        <thead class="text-center">
                            <tbody class="text-center">
                                <td>691 A</td>
                                <td>250</td>
                                <td>06-05-2024</td>
                                <td>06:45 - 09:45</td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm">Asignar</button>
                                </td>
                            </tbody>
                        </thead>
                    </table>
                </div>   
            </form>
        </div>
    </div>
</div>
<!-- Agregar un event listener para el botón de búsqueda -->
<script>
    document.getElementById('btn-buscarAmbiente').addEventListener('click', function() {
    // Mostrar la tabla al hacer clic en el botón de búsqueda
    document.getElementById('tabla').style.display = 'block';
});
    </script>
@endsection