@extends('reservas/admin/principal')

@section('contenido-pendientes')

<?php
    use App\Models\Usuarios;
    use App\Models\PeriodosSeleccionado;
    use App\Models\Periodos;
?>

<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="mb-3">
        <form action= "{{ route('reservas.pendientes.buscar') }}" method="POST">
            @csrf
            <!-- FILTRADO -->
            <div class ="filtrado">
                <!-- CHECKBOX PARA FILTRAR LA LISTA DE RESERVAS -->
                <div class="form-check">
                    <input name="checkbox_estado" id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        Filtrado:
                    </label>
                </div>
        
                <!-- Campo de tipo oculto para el valor del checkbox -->
                <input type="hidden" id="checkboxEstadoHidden" name="checkbox_estado" value="0">
              
                <div class= "row" style="padding-left: 25px; padding-right: 25px;">
                    <!-- RANGO DE LAS FECHAS INICIAL Y FINAL -->
                    <div class="col">
                        <!-- Seleccionable de fecha inicial -->
                        <label for="fecha-name" class="col-form-label h4">Fecha inicial:</label>
                        <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                            <input name="fecha_inicial" id="fechaInputInicial" class="form-control" type="text" value="" readonly />               
                            <span class="input-group-addon"></span>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Seleccionable de fecha final -->
                        <label for="fecha-name" class="col-form-label h4">Fecha final:</label>
                        <div id="datepicker-final" class="input-group date" data-date-format="dd-mm-yyyy">
                            <input name="fecha_final" id="fechaInputFinal" class="form-control" type="text" value="" readonly />               
                            <span class="input-group-addon"></span>
                        </div>
                    </div>
                </div>
                <div class="buscar" style="text-align: right; padding-top: 20px; padding-right: 25px;">
                    <button type="submit" class="btn btn-primary custom-btn"><i class="bi bi-search"></i> Buscar</button>
                </div>
            </div>
        </form>
        {{-- ********************   tabla ***********************--}}
          @if (session()->get('reservasFiltradas'))

               <?php 
                    //capturo las materias que me envia mi controlador consultar materias a esta vista
                    $reservasFiltradas = session()->get('reservasFiltradas');
                    $tamReservasFil = count($reservasFiltradas);
                    //  dd($reservasFiltradas,$tamReservasFil);
               ?>
            <!-- TABLA DE LA LISTA DE RESERVAS DE LOS DOCENTES -->
            <div class="col"> 
                
                <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="bg-custom-lista">
                                <tr>
                                    <th class="text-center h4 text-white">Fecha</th>
                                    <th class="text-center h4 text-white">Hora inicio</th>
                                    <th class="text-center h4 text-white">Hora fin</th>
                                    <th class="text-center h4 text-white">Docente</th>
                                    <th class="text-center h4 text-white">Opciones</th>
                                </tr>
                              
                            </thead>
                            
                            {{-- Cuerpo --}}

                            <tbody> 

                                @for ( $i = 0 ; $i <  $tamReservasFil; $i++)

                                    <?php
                                       
                                        $idReserva = $reservasFiltradas[$i]->id;
                                        $tipo = $reservasFiltradas[$i]->Tipo;
                                        $estadoReserva = $reservasFiltradas[$i]->Estado;
                                        $fecha = $reservasFiltradas[$i]->fecha;
                                        
                                        $docenteId = $reservasFiltradas[$i]->docentes_id;
                                        $buscarDocente = Usuarios::where('id',$docenteId)->first();
                                        $nombreDocente = $buscarDocente->name;
                                        
                                        $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
                                        $tamPeriodosSeleccionado = count($periodosSeleccionados);
                                        // dd($tamPeriodoSelec);

                                        if($tamPeriodosSeleccionado == 1){
                                            $periodoId = $periodosSeleccionados[0]->periodos_id;
                                            
                                            $periodoBuscar = Periodos :: where('id',$periodoId)->first();
                                            $periodo = $periodoBuscar->HoraIntervalo;
                                            $partes_P = explode('-', $periodo);
                                            // if($i==2){dd($partes_P);}
                                            
                                            $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
                                            $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                                        
                                            // if($i==2){ dd($horaInicio,$horaFin);}
                                            // dd($horaInicio,$horaFin);
                                        }else{
                        
                                            $periodoId = $periodosSeleccionados[0]->periodos_id;
                                            $periodoId2 = $periodosSeleccionados[1]->periodos_id;

                                            $periodoBuscar = Periodos :: where('id',$periodoId)->first();     
                                            $periodoBuscar2 = Periodos :: where('id',$periodoId2)->first();

                                            $periodo = $periodoBuscar->HoraIntervalo;
                                            $periodo2 = $periodoBuscar2->HoraIntervalo;
                                            
                                            $partes_P = explode('-', $periodo);
                                            $partes_P2 = explode('-', $periodo2);
                                            //dd($partes_P,$partes_P2);

                                            $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
                                            $horaFin = trim(str_replace(' ', '', $partes_P2[1]));
                                            
                                            // if($i==1){dd($horaInicio,$horaFin);}
                                        
                                        }

                                    ?>
                                    
                                    @if ($i % 2 == 0)
                                        @if ($estadoReserva == "pendiente")
                                            
                                            <!-- Fila Ploma -->
                                            <thead class="bg-custom-lista-fila-plomo">	
                                                <tr>
                                                    <th class="text-center h4 text-black">{{ $fecha }}</th>
                                                    <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                                                    <th class="text-center h4 text-black">{{ $horaFin }}</th>
                                                    <th class="text-center h4 text-black">{{ $nombreDocente }}</th>
                                                    <th class="text-center h4 text-black">
                                                        <div class="d-flex justify-content-center">
                                                            <!-- SI ES RESERVA INDIVIDUAL SE MUESTRA ESTA HOJA DE VER -->
                                                            <div class="circle2">
                                                                
                                                                @if ($tipo=='individual')
                                                                    <a href="{{ route('reservas.verIndividual',['idReserva'=>$idReserva])}}" class="btn btn-fab" title="Ver"> 
                                                                        <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                                                    </a>
                                                                @elseif($tipo=='grupal')
                                                                    <a href="{{ route('reservas.verGrupal',['idReserva'=>$idReserva])}}" class="btn btn-fab" title="Ver"> 
                                                                        <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead> 
                                            
                                        @endif
                                    @else
                                        @if ($estadoReserva == "pendiente")
                   
                                            <!-- Fila blanca -->
                                            <thead class="bg-custom-lista-fila-blanco">
                                                <tr>
                                                    <th class="text-center h4 text-black">{{ $fecha }}</th>
                                                    <th class="text-center h4 text-black">{{ $horaInicio }}</th>
                                                    <th class="text-center h4 text-black">{{ $horaFin }}</th>
                                                    <th class="text-center h4 text-black">{{ $nombreDocente }}</th>
                                                    <th class="text-center h4 text-black">
                                                        <div class="d-flex justify-content-center">
                                                            <!-- SI ES RESERVA GRUPAL SE MUESTRA ESTA HOJA DE VER -->
                                                            <div class="circle2">

                                                                @if ($tipo=='individual')
                                                                    <a href="{{ route('reservas.verIndividual',['idReserva'=>$idReserva])}}" class="btn btn-fab" title="Ver"> 
                                                                        <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                                                    </a>
                                                                @elseif($tipo=='grupal')
                                                                    <a href="{{ route('reservas.verGrupal',['idReserva'=>$idReserva])}}" class="btn btn-fab" title="Ver"> 
                                                                        <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead> 	   
                                        
                                        @endif
                                    @endif

                                @endfor

                            </tbody>
                           
                            
                        </table>
                </div>
                
            </div> 

          @endif
       
    
    </div>
</div>

<script>
    // Esperar a que se cargue completamente el DOM
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el checkbox y el campo oculto
        var checkbox = document.getElementById("flexCheckDefault");
        var checkboxHidden = document.getElementById("checkboxEstadoHidden");

        // Escuchar cambios en el checkbox
        checkbox.addEventListener("change", function() {
            // Si el checkbox está marcado, establecer el valor del campo oculto en "1", de lo contrario en "0"
            if (this.checked) {
                checkboxHidden.value = "1";
            } else {
                checkboxHidden.value = "0";
            }
        });
    });
</script>

@endsection