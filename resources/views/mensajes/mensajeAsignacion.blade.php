<!DOCTYPE html>
<html lang="es">
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

<body>
    <div class="container">
        <header class="header">
            <h1>Asignación de solicitud de reserva</h1>
            <p>Sábado, 18 de mayo (hace 17 horas)</p>
        </header>
        <main class="main-content">
            <div class="centered-text">
                <p>Estimado/a,</p>
                <p>¡Esperamos que este mensaje te encuentre muy bien! Te escribimos desde el Sistema de Reservas FCyT. Se informa que su solicitud de reserva ha sido aceptada.</p>
            </div>
            <section class="reservation-details">
                <h2>Detalle de reserva (Individual):</h2>
                <table>
                    <tr>
                        <td>Nombre docente:</td>
                        <td>Leticia Blanco Coca</td>
                    </tr>
                    <tr>
                        <td>Cantidad de estudiantes:</td>
                        <td>95</td>
                    </tr>
                    <tr>
                        <td>Motivo reserva:</td>
                        <td>Examen primer parcial</td>
                    </tr>
                    <tr>
                        <td>Fecha:</td>
                        <td>05/06/2024</td>
                    </tr>
                    <tr>
                        <td>Periodo:</td>
                        <td>8:15 - 9:45</td>
                    </tr>
                    <tr>
                        <td>Tipo de ambiente:</td>
                        <td>Aula común</td>
                    </tr>
                    <tr>
                        <td>Materia:</td>
                        <td>Elementos de programación</td>
                    </tr>
                    <tr>
                        <td>Grupo(s):</td>
                        <td>1, 2</td>
                    </tr>
                </table>
            </section>
            <section class="assigned-room">
                <h2>Detalle de ambiente asignado:</h2>
                <ul class="assigned-list">
                    <li><span>Ambiente:</span> 690 A</li>
                    <li><span>Capacidad:</span> 100</li>
                    <li><span>Ubicación:</span> Edificio Nuevo</li>
                    <li><span>Tipo de ambiente:</span> Aula común</li>
                    <li><span>Periodo:</span> 8:15 - 9:45</li>
                    <li><span>Fecha:</span> 05/06/2024</li>
                </ul>
            </section>
            <p class="center-text">Agradecemos tu atención y estamos aquí para cualquier consulta.<br>Atentamente, Administrador.</p>
            <div class="footer">
                <p>Este mensaje ha sido generado automáticamente por el sistema de reservas. Si no esperabas este correo, o tienes alguna duda, por favor contáctanos.</p>
            </div>
        </main>
    </div>
</body>
</html>
