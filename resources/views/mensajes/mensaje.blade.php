<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .email-header {
            background: rgb(9,30,214);
			background: linear-gradient(90deg, rgba(9,30,214,1) 0%, rgba(92,9,121,1) 44%, rgba(222,13,13,1) 100%);
            color: #ffffff;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .email-body {
            padding: 20px;
            color: #444444;
        }
        .email-footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #dddddd;
            text-align: center;
            font-size: 12px;
            color: #888888;
        }
        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .email-footer a:hover {
            text-decoration: underline;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            margin-right: 10px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s ease-in-out;
        }
        .button.accept {
            background: linear-gradient(to right, #4CAF50, #45a049);
        }
        .button.reject {
            background: linear-gradient(to right, #f44336, #ff1744);
        }
        .button:hover {
            filter: brightness(120%);
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ $details['title'] }}</h1>
        </div>
        <div class="email-body">
            <h3>Estimado/a.</h3>

            <h4>¡Esperamos que este mensaje te encuentre muy bien! Te escribimos desde el "Sistema de Reservas FCyT".</h4>

            <h3>Detalles de tu reserva:</h3>

            <h4>{{ $details['body'] }}</h4>

            <h4>Agradecemos tu atención y estamos aquí para cualquier consulta.</h4>

            <h4>Atentamente, {{ $details['emisor'] }}</h4>

            <p>
            Este mensaje ha sido generado automáticamente por el sistema de reservas. Si no esperabas este correo o tienes alguna duda, por favor contáctanos.
            </p>
            <div style="text-align: center;">
                <a href="#" class="button accept">Aceptar</a>
                <a href="#" class="button reject">Rechazar</a>
            </div>
        </div>
        <div class="email-footer">
            <p>¡Gracias por tu atención!</p>
            <p>Para más información, visita nuestro <a href="#" style="color: #4CAF50;">sitio web</a>.</p>
            <p>&copy; {{ date('Y') }} Sistema de Reservas. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
