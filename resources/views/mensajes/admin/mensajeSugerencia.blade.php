<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Solicitud de Reserva</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        .column-container {
            display: flex;
            gap: 20px; /* espacio entre las columnas */
        }

        .column-container .assigned-list {
            flex: 1; /* para que ambas columnas ocupen el mismo espacio */
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

<body>
        <?php
            use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente
            // Obtener la fecha y hora actual en la zona horaria de Bolivia
            $fechaEnvio = Carbon::now('America/La_Paz');

            // Formatear la fecha de envío
            $fechaEnvioFormateada = $fechaEnvio->locale('es')->isoFormat('dddd, D [de] MMMM');
            $horaEnvio = $fechaEnvio->format('H:i');
        ?>
    <div class="container">
        <header class="header">
            <h1>Sugerencia de solicitud de Reserva {{ $details['estado'] }}</h1>
            <p><?php echo $fechaEnvioFormateada; ?> (a las <?php echo $horaEnvio; ?>)</p>
        </header>
        <main class="main-content">
            <div class="centered-text">
                <p>Estimado/a Administrador,</p>
                <!--NOMBRE DEL DOCENTE QUE ACEPTO O RECHAZO LA SOLICUTUD-->
                <p>{{ $details['docente'] }} a {{ $details['estado'] }} la sugerencia de solicitud de reserva de ambientes.</p>
            </div>
            <section class="reservation-details">
                <h2>Detalle de reserva (Individual O Grupal):</h2>
                <table>
                    <tr>
                        <td>Nombre docente:</td>
                        <td>{{ $details['docente'] }}</td>
                    </tr>
                    <tr>
                        <td>Cantidad de estudiantes:</td>
                        <td>{{ $details['cantidad'] }}</td>
                    </tr>
                    <tr>
                        <td>Motivo reserva:</td>
                        <td>{{ $details['motivo'] }}</td>
                    </tr>
                    <tr>
                        <td>Fecha:</td>
                        <td>{{ $details['fecha'] }}</td>
                    </tr>
                    <tr>
                        <td>Periodo:</td>
                        <td>{{ $details['periodo'] }}</td>
                    </tr>
                    <tr>
                        <td>Tipo de ambiente:</td>
                        <td>{{ $details['ambiente'] }}</td>
                    </tr>
                    <tr>
                        <td>Materia:</td>
                        <td>{{ $details['materia'] }}</td>
                    </tr>
                    <tr>
                        <td>Grupo(s):</td>
                        <!--SI ES INIVIDUAL SOLO MOSTRAR EL NUMERO DE GRUPO-->
                        <!--SI ES GRUPAL  MOSTRAR EL NUMERO DE GRUPO Y DOCENTE-->
                        <td>{{ $details['grupo'] }}</td>
                    </tr>
                </table>
            </section>
            <section class="assigned-room">
                <h2>Detalle Ambientes Sugeridos:</h2>
                <div class="column-container">
                    <!-- PARA EL AMBIENTE 1 -->
                    <ul class="assigned-list">
                        <li><span>Ambiente:</span> {{ $details['ambiente1'] }}</li>
                        <li><span>Capacidad:</span> {{ $details['capacidad1'] }}</li>
                        <li><span>Ubicación:</span> {{ $details['ubicacion1'] }}</li>
                        <li><span>Tipo de ambiente:</span> {{ $details['tipo1'] }}</li>
                        <li><span>Periodo:</span> {{ $details['periodo1'] }}</li>
                        <li><span>Fecha:</span> {{ $details['fecha1'] }}</li>
                    </ul>
                    <ul class="assigned-list">
                        <!-- PARA EL AMBIENTE 2 -->
                        <li><span>Ambiente:</span> {{ $details['ambiente2'] }}</li>
                        <li><span>Capacidad:</span> {{ $details['capacidad2'] }}</li>
                        <li><span>Ubicación:</span> {{ $details['ubicacion2'] }}</li>
                        <li><span>Tipo de ambiente:</span> {{ $details['tipo2'] }}</li>
                        <li><span>Periodo:</span> {{ $details['periodo2'] }}</li>
                        <li><span>Fecha:</span> {{ $details['fecha2'] }}</li>
                    </ul>
                </div>
            </section>
            <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary">Continuar con la Reserva</button>
                    <p class="mt-2 mb-0">Link:</p>
                    <a href="https://www.google.com" target="_blank">Ir a Google</a>
            </div>
            <p class="center-text">Agradecemos tu atención y estamos aquí para cualquier consulta.<br>Atentamente, {{ $details['emisor'] }}.</p>
            <div class="footer">
                <p>Este mensaje ha sido generado automáticamente por el sistema de reservas. Si no esperabas este correo, o tienes alguna duda, por favor contáctanos.</p>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>