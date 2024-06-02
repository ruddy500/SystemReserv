<!DOCTYPE html>
<html lang="es">

<?php
use App\Models\Ambientes;
// use App\Models\Reservas;
// use App\Models\Usuarios;
// use App\Models\Motivos;
// use App\Models\MateriasSeleccionado;
use App\Models\Materias;
use App\Models\PeriodosSeleccionado;
use App\Models\Periodos;
use App\Models\ReservasAmbiente;
use App\Models\NombreAmbientes;
use App\Models\TipoAmbientes;
use App\Models\DocentesMaterias;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente

// Establecer la zona horaria predeterminada
date_default_timezone_set('America/La_Paz');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Solicitud de Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            background-color: #003366;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .main-content {
            margin: 20px 0;
        }

        .centered-text {
            text-align: center;
            margin-bottom: 20px;
        }

        .reservation-details, .assigned-room {
            margin: 20px 0;
        }

        h2 {
            border-bottom: 2px solid #003366;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .responsive-table-container {
            overflow-x: auto;
        }

        .assigned-list {
            list-style: none;
            padding: 0;
        }

        .assigned-list li {
            border: 1px solid #ddd;
            padding: 8px;
            margin-bottom: 5px;
            background-color: #f9f9f9;
        }

        .assigned-list li span {
            font-weight: bold;
        }
        .center-text {
            text-align: center;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }

        .footer {
            border-top: 1px solid #dcdcdc;
            padding-top: 10px;
            margin-top: 20px;
        }

        .footer p {
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<?php 
    use App\Models\Reservas;
    use App\Models\Usuarios;
    use App\Models\Motivos;
    use App\Models\MateriasSeleccionado;
    $reserva = Reservas::find($idReserva); //extraemos la reserva actual
    

    $idDocente = $reserva->docentes_id;
    $DocenteAux = Usuarios::find($idDocente);
    $tipoReserva = $reserva->Tipo ; //vamos a mostrar el tipo de la reserva

    $MotivoId = $reserva->motivos_id;
    $motivo = Motivos::find($MotivoId); //encontramos el motivo de la reserva
    
    $registrosMatSelec = MateriasSeleccionado::where('reservas_id',$idReserva)->get();
    // dd($registrosMatSelec);
    $idMateria = $registrosMatSelec[0]->materias_id;
    $registroMateria = Materias::where('id',$idMateria)->first();
    $nombreMateria = $registroMateria->Nombre;    
    // dd($nombreMateria);

    // vamos a ver los peridos seleccionados
    $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
    $tamPeriodosSeleccionado = count($periodosSeleccionados);
    // dd($tamPeriodoSelec);

    if($tamPeriodosSeleccionado == 1){
        $periodoId = $periodosSeleccionados[0]->periodos_id;
                    
        $periodoBuscar = Periodos :: where('id',$periodoId)->first();
        $periodo = $periodoBuscar->HoraIntervalo;
        $partes_P = explode('-', $periodo);
                    
        $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
        $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                
    }
    else{

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
        }

        
    ?>

<body>
    <div class="container">
        <?php
            // Obtener la fecha y hora actual en la zona horaria de Bolivia
            $fechaEnvio = Carbon::now('America/La_Paz');

            // Formatear la fecha de envío
            $fechaEnvioFormateada = $fechaEnvio->locale('es')->isoFormat('dddd, D [de] MMMM');
            $horaEnvio = $fechaEnvio->format('H:i');
        ?>

        <header class="header">
            <h1>Rechazo de solicitud de reserva</h1>
            <p><?php echo $fechaEnvioFormateada; ?> (a las <?php echo $horaEnvio; ?>)</p>
        </header>
        <main class="main-content">
            <div class="centered-text">
                <p>{{ $details['body'] }}</p>
                
            </div>
            <section class="reservation-details">
                <h2>Detalle de reserva ({{$tipoReserva}}):</h2>
                <table>
                    <tr>
                        <td>Nombre docente:</td>
                        <td>{{$DocenteAux->name}}</td>
                    </tr>
                    <tr>
                        <td>Cantidad de estudiantes:</td>
                        <td>{{$reserva->CantEstudiante}}</td>
                    </tr>
                    <tr>
                        <td>Motivo reserva:</td>
                        <td>{{$motivo->Nombre}}</td>
                    </tr>
                    <tr>
                        <td>Fecha:</td>
                        <td>{{$reserva->fecha}}</td>
                    </tr>
                    <tr>
                        <td>Periodo:</td>
                        <td>{{ $horaInicio }} - {{ $horaFin }}</td>
                    </tr>
                    <tr>
                        <td>Tipo de ambiente:</td>
                        <td>{{$reserva->TipoAmbiente}}</td>
                    </tr>
                    <tr>
                        <td>Materia:</td>
                        <td>{{$nombreMateria}}</td>
                    </tr>
                    <tr>
                        <!-- SI ES GRUPAL AUMENTAR EL NOMBRE DEL DOCENTE A LADO DEL GRUPO -->
                        <td>Grupo(s):</td>
                        {{-- <td>1, 2</td> --}}
                        <?php
                                $gruposMateria = [];
                            ?>
                            @if ($tipoReserva == "individual")
                                @foreach ($registrosMatSelec as $registroMatSelec)
                                    <?php
                                        $idMateria = $registroMatSelec->materias_id;
                                        $materia = Materias::where('id',$idMateria)->first();
                                        $gruposMateria[] = $materia->Grupo;
                                    ?>
                                @endforeach
                                <td>{{ implode(', ', $gruposMateria) }}</td>
                            @else
                                @foreach ($registrosMatSelec as $registroMatSelec)
                                    <?php
                                        $idMateria = $registroMatSelec->materias_id;
                                        $materia = Materias::where('id',$idMateria)->first();
                                        
                                        $registroDocMat = DocentesMaterias::where('materias_id',$idMateria)->first();
                                        $idDocente = $registroDocMat->docentes_id;
                                        $registroDocente = Usuarios::where('id',$idDocente)->first();
                                        $nombreDocente = $registroDocente->name;
                                        
                                        $grupo = $materia->Grupo;
                                        $gruposMateria[] = "$grupo, $nombreDocente";
                                    ?>
                                @endforeach              
                                <td>
                                    @foreach($gruposMateria as $entry)
                                        {{ $entry }}<br>
                                    @endforeach
                                </td>
                            @endif
                        <!-- <td>1, Leticia Coca Blanco<br>3, Vladimir Costas</td> ASI SE TENDRIA QUE VER -->
                    </tr>
                </table>
                <?php 
                $reserva->Estado = 'rechazado';
                $reserva->save();

                ?>
            </section>
            <p class="center-text">Agradecemos tu atención y estamos aquí para cualquier consulta.<br>Atentamente, Administrador.</p>
            <div class="footer">
                <p>Este mensaje ha sido generado automáticamente por el sistema de reservas. Si no esperabas este correo, o tienes alguna duda, por favor contáctanos.</p>
            </div>
        </main>
    </div>
</body>
</html>
