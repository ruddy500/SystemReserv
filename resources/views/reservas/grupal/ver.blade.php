@extends('index')
<?php 
use App\Models\Reservas;
use App\Models\ReservasAmbiente;
use App\Models\NombreAmbientes;
use App\Models\Ambientes;
use App\Models\Fechas;
use App\Models\PeriodosSeleccionado;
use App\Models\Periodos;
use App\Models\Motivos;
use App\Models\Materias;
use App\Models\DocentesMaterias;
use App\Models\Usuarios;

// $materiaBuscada = Materias::find(1);
// $idMateriaBuscada = $materiaBuscada->id;
// // dd($idMateriaBuscada);

// // Aquí buscamos en DocentesMaterias
// $materiaBuscadaDocentes =DocentesMaterias::where('materias_id', $idMateriaBuscada)->first();
// $idDocente = $materiaBuscadaDocentes->docentes_id;
// // dd($idDocente);

// // aqui buscamos en el usuario Docente
// $docente = Usuarios::where('id', $idDocente)->first();
// $nombreDocente = $docente->name;
// dd($nombreDocente);


$reserva = Reservas::find($idReserva); //extraemos la reserva actual

// buscamos el motivo de la reserva
$motivoReserva = $reserva->motivo->Nombre;

$reservaMateria = Reservas::with('materiasSeleccionado')->find($idReserva);
// dd($reservaMateria);
if ($reservaMateria) {
    $numeros = $reservaMateria->materiasSeleccionado->pluck('materias_id')->toArray();
    // Aquí $numeros contendrá los números (idMateria) de las materias seleccionadas de la reserva con ID 1
}
// dd($numeros);

// ahora vamos a seleccionar una materia en especifico
$materia = Materias::find($numeros[0]);
// dd($materia)



// ahora veremos los peridos seleccionados 
$periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
$tamPeriodosSeleccionado = count($periodosSeleccionados);
             
             if($tamPeriodosSeleccionado == 1){
                $periodoId = $periodosSeleccionados[0]->periodos_id;
                
                $periodoBuscar = Periodos :: where('id',$periodoId)->first();
                $periodo = $periodoBuscar->HoraIntervalo;
                $partes_P = explode('-', $periodo);
                // if($i==3){dd($partes_P);}
                
                $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
                $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                // if($i==3){dd($horaInicio,$horaFin);}
                $unido = $horaInicio.' - '.$horaFin;

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
            //dd($horaInicio,$horaFin);
            //xd
             $unido = $horaInicio.' - '.$horaFin;

             }


?>
@section('reservas/verGrupal')
<div class="container mt-3">
	<div class="card vercard">
		<h3 class="card-header">Reservas</h3>
        <div class="card-body bg-content">
            <div class ="card details-card">
                <h3 class="card-header details-header">Reserva grupal</h3>                                    
                <div class="card-body bg-content">
                    <div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="table_encabezado_color">
                                    <td colspan="2">Detalle</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Nombre docente</td>
                                    <?php 
                                        $idDocente = $reserva->docentes_id;
                                        $DocenteAux = Usuarios::find($idDocente);

                                        // dd($DocenteAux->name);
                                    ?>
                                    <td style="width: 50%;">{{$DocenteAux->name}}</td>
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
                                    <td style="width: 50%;">{{$unido}}</td>
                                </tr>
                                <!-- VISTA DETALLE TIPO DE AMBIENTE -->
                                <tr>
                                    <td style="width: 50%;">Tipo de ambiente</td>
                                    <td style="width: 50%;">{{$reserva->TipoAmbiente}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Materia</td>
                                    <td style="width: 50%;">{{$materia->Nombre}}</td>
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
                                            <th class="col" style="width: 50%;">Nombre docente</th>
                                            <th scope="col" style="width: 25%;">Grupo</th>
                                            <th scope="col" style="width: 25%;">Inscritos</th>
                                        </tr>
                                    </thead>
                                </thead>
                                <thead class="text-center">
                                    <tbody class="text-center">
                                        
                                        @foreach($numeros as $numero)
                                        <tr>
                                            <?php 
                                                $materiaBuscada = Materias::find($numero);
                                                $idMateriaBuscada = $materiaBuscada->id;
                                                // dd($idMateriaBuscada);

                                                // Aquí buscamos en DocentesMaterias
                                                $materiaBuscadaDocentes =DocentesMaterias::where('materias_id', $idMateriaBuscada)->first();
                                                $idDocente = $materiaBuscadaDocentes->docentes_id;
                                                // dd($idDocente);

                                                // aqui buscamos en el usuario Docente
                                                $docente = Usuarios::where('id', $idDocente)->first();
                                                $nombreDocente = $docente->name;
                                                // dd($nombreDocente);

                                             ?>
                                            <td>{{$nombreDocente}}</td>
                                            <td>{{Materias::find($numero)->Grupo}}</td>
                                            <td>{{Materias::find($numero)->Inscritos}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody> 
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