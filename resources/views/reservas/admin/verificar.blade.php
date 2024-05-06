@extends('index')
{{-- {{ dd(get_defined_vars()) }} --}}
@section('reservas/verificar')
<div class="container mt-3">
	<div class="card vercard">
		<h3 class="card-header">Verificación de reserva</h3>
        <div class="card-body bg-content">
            <!-- TABLA DE DETALLE DE RESERVA -->
            {{-- <form action= "{{ route('reservas.ambientes.buscar') }}" method="POST"> --}}
            <form action="{{ route('reservas.ambientes.buscar',['idReserva'=>$idReserva]) }}" method="POST">
        
                @csrf
            <div class = "datos-reserva">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">Cantidad de estudiantes</td>
                            <td style="width: 50%;">{{$reserva->CantEstudiante}}</td>
                            <input type="hidden" id="cantidad-reserva" name="cantidad_reserva" value="{{$reserva->CantEstudiante}}">
                        </tr>  
                        <tr>
                            <td style="width: 50%;">Fecha</td>
                            <td style="width: 50%;">{{$reserva->fecha}}</td>
                            <input type="hidden" id="fecha-reserva" name="fecha_reserva" value="{{$reserva->fecha}}">
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
                                                  //  dd($periodo[$periodos[$i]->periodos_id - 1]->HoraIntervalo);
                                                @endphp
                                                <td id='borrar' style="width: 50%;">{{$periodo[$periodos[$i]->periodos_id - 1]->HoraIntervalo}}</td>
                                                <input type="hidden" id="periodo-reserva" name="periodo_reserva_uno" value="{{$periodo[$periodos[$i]->periodos_id - 1]->HoraIntervalo}}">
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
                                                <input type="hidden" id="periodo-reserva" name="periodo_reserva" value="{{$periodo1}} / {{$periodo2}}">
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
                    {{-- <button type="submit" class="btn btn-primary custom-btn"><i class="bi bi-search"></i> Buscar</button> --}}
                    {{-- <button id="btn-buscarAmbiente" type="button" class="btn btn-primary custom-btn"><i class="bi bi-search"></i> Buscar</button> --}}
                </div>
            </div>
        </form>
        {{-- {{ dd(get_defined_vars()) }} --}}
            <!-- TABLA DE AMBIENTES DISPONIBLES QUE CUMPLEN CON LOS REQUISITOS-->
            {{-- <form id="tabla-ambientesdisponibles" action= ""  method="POST"> --}}
                <div id= "tabla" class="table-responsive" style="max-height: 300px; overflow-y: auto; padding-top: 15px; display: none;">
                    <table id="horario-tabla" class="table caption-top table-bordered ">
                        <thead class="table_encabezado_color text-center">
                            <td colspan="5">Ambientes Disponibles</td>
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
                              
                                {{-- {{ dd(get_defined_vars()) }} --}}
                           

                                {{-- @if(isset($ambientesEncontrados)) --}}
                                {{-- {{ dd(get_defined_vars()) }} --}}
                                {{-- @foreach($ambientesEncontrados as $ambi) --}}
                                <td>691 A</td>
                                {{-- <td>{{$ambi->ambientes_id}}</td> --}}
                                <td>250</td>
                                {{-- <td>{{$ambi->fechas_id}}</td> --}}
                                <td>06-05-2024</td>
                                <td>06:45 - 09:45</td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm">Asignar</button>
                                </td>
                                {{-- @endforeach --}}
                                {{-- @endif --}}
                            </tbody>
                        </thead>
                    </table>
                </div>   
            
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
{{-- 
<script>
    $(document).ready(function() {
        $('#btn-buscarAmbiente').click(function(e) {
            e.preventDefault(); // Evita el comportamiento predeterminado del botón de enviar

            // Obtén el formulario
            var form = $(this).closest('form');

            // Realiza la solicitud AJAX
            $.ajax({
                url: form.attr('reservas.verificar'), // URL a la que se enviará el formulario
                type: form.attr('POST'), // Método del formulario (POST en este caso)
                data: form.serialize(), // Datos del formulario
                success: function(response) {
                    // Actualiza la tabla de ambientes disponibles con la respuesta del servidor
                    $('#tabla').html(response);
                },
                error: function(xhr, status, error) {
                    // Maneja los errores si es necesario
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
@endsection