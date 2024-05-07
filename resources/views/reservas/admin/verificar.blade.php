@extends('index')
@section('reservas/verificar')
<?php 
use App\Models\Ambientes;
use App\Models\NombreAmbientes;
?>
<div class="container mt-3">
	<div class="card vercard">
		<h3 class="card-header">Verificación de reserva</h3>
        <div class="card-body bg-content">
            <!-- TABLA DE DETALLE DE RESERVA -->
            <form action="{{ route('reservas.ambientes.buscar',['idReserva'=>$idReserva]) }}" method="POST">
                {{-- {{ dd(get_defined_vars()) }}  --}}
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
                                                 <input type="hidden" id="periodo-reserva-dos" name="periodo_reserva_dos" value="{{$inicio}} - {{$fin}}">
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
                @if (session()->get('ambientesEncontradosComplet'))
                {{-- {{ dd(get_defined_vars()) }} --}}
                
                <?php 
                 //capturo las materias que me envia mi controlador consultar materias a esta vista
                 $ambientesEncontradosComplet = session()->get('ambientesEncontradosComplet');
                //  $ambientesDosPeriodosComplet = session()->get('ambientesDosPeriodosComplet');
               //  dd($ambientesEncontradosComplet);
                ?>
            

                <div class="col"> 
                
                    <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="bg-custom-lista text-center h4">
                                    <td colspan="5" class="text-center h4 text-white">Ambientes Disponibles</td>
                                    <tr>
                                        <th class="text-center h4 text-white">Nombre ambiente</th>
                                        <th class="text-center h4 text-white">Capacidad </th>
                                        <th class="text-center h4 text-white">Fecha</th>
                                        <th class="text-center h4 text-white">Periodo</th>
                                        <th class="text-center h4 text-white">Opciones</th>
                                    </tr>
                                </thead>
                                @foreach($ambientesEncontradosComplet as $ambi)

                                <script>
                                    // Obtener el valor del campo oculto y almacenarlo en una variable de JavaScript
                                    var periodoReservaUno = document.getElementById('periodo-reserva').value;
                                    
                                </script>
                                @php
                                $aa = $ambi->ambientes_id;
                                $registroAmbiente = Ambientes::find($aa);
                                $idNombAmb = $registroAmbiente->nombre_ambientes_id;
                                $nombreAmbiente = NombreAmbientes::find($idNombAmb)->Nombre;

                                $capacidad = $registroAmbiente->Capacidad;

                                
                                // dd($periodo[$periodos[$i]->periodos_id - 1]->HoraIntervalo);

                                @endphp
            
            
                            
                                <tbody>  
                                    <!-- Fila blanca -->
                                    <thead class="bg-custom-lista-fila-blanco">
                                        <tr>
                                            <th class="text-center h4 text-black">{{$nombreAmbiente}}</th>
                                            <th class="text-center h4 text-black">{{$capacidad}}</th>
                                            <th class="text-center h4 text-black">{{$reserva->fecha}}</th>
                                            {{-- $inicio = trim(str_replace(' ', '', $partes_P1[0]));
                                                    $fin = trim(str_replace(' ', '', $partes_P2[1])); --}}
                                            <th class="text-center h4 text-black"><script>document.write(periodoReservaUno);</script></th>
                                            {{-- <th class="text-center h4 text-black"><script>document.write(periodoReservaUno);</script></th> --}}
                                            <th class="text-center h4 text-black"> <button type="button" class="btn btn-secondary btn-sm">Asignar</button>
                                            </th>
                                        </tr>
                                    </thead> 	   

                                </tbody>
                                @endforeach
                            </table> 
                    </div>
                </div>
            {{-- @else --}}
            @elseif (session()->get('ambientesDosPeriodosComplet'))
            <?php 
                 //capturo las materias que me envia mi controlador consultar materias a esta vista
                //  $ambientesEncontradosComplet = session()->get('ambientesEncontradosComplet');
                $ambientesDosPeriodosComplet = session()->get('ambientesDosPeriodosComplet');
                //  dd($ambientesDosPeriodosComplet);
                ?>
                
    {{-- Código relacionado con ambientesEncontradosComplet --}}

    <div class="col"> 
                
        <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="bg-custom-lista text-center h4">
                        <td colspan="5" class="text-center h4 text-white">Ambientes Disponibles</td>
                        <tr>
                            <th class="text-center h4 text-white">Nombre ambiente</th>
                            <th class="text-center h4 text-white">Capacidad </th>
                            <th class="text-center h4 text-white">Fecha</th>
                            <th class="text-center h4 text-white">Periodo</th>
                            <th class="text-center h4 text-white">Opciones</th>
                        </tr>
                    </thead>

                    @php
                      $lastNombreAmbiente = null; // Variable para almacenar el último nombre de ambiente
                    @endphp

                    @foreach($ambientesDosPeriodosComplet as $ambi)
                    <script>
                        // Obtener el valor del campo oculto y almacenarlo en una variable de JavaScript
                        var periodoReservaDos = document.getElementById('periodo-reserva-dos').value;
                        
                    </script>
                        @php
                        $ambienteID = $ambi->ambientes_id;
                        $registroAmbiente = Ambientes::find($ambienteID);
                        $idNombAmb = $registroAmbiente->nombre_ambientes_id;
                        $nombreAmbiente = NombreAmbientes::find($idNombAmb)->Nombre;

                        $capacidad = $registroAmbiente->Capacidad;

                        // Verificar si el nombre de ambiente actual es diferente al anterior
                        $printRow = $nombreAmbiente !== $lastNombreAmbiente;
                        $lastNombreAmbiente = $nombreAmbiente; // Actualizar el último nombre de ambiente
                        @endphp

                        @if ($printRow)
                            <tbody>  
                                <thead class="bg-custom-lista-fila-blanco">
                                    <tr>
                                        <th class="text-center h4 text-black">{{$nombreAmbiente}}</th>
                                        <th class="text-center h4 text-black">{{$capacidad}}</th>
                                        <th class="text-center h4 text-black">{{$reserva->fecha}}</th>
                                        <th class="text-center h4 text-black"><script>document.write(periodoReservaDos);</script></th>
                                        <th class="text-center h4 text-black"> <button type="button" class="btn btn-secondary btn-sm">Asignar</button>
                                        </th>
                                    </tr>
                                </thead> 
                            </tbody>
                        @endif
                    @endforeach
                </table> 
        </div>
    </div>
@else
            @endif
@endsection