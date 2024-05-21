<!DOCTYPE html>
<html>
<head>
    <title>Mensaje</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .email-body {
            padding: 20px;
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
            color: #007bff;
            text-decoration: none;
        }
        .email-footer a:hover {
            text-decoration: underline;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ $details['title'] }}</h1>
        </div>
        <div class="email-body">
            <p>{{ $details['body'] }}</p>
            <!-- <a href="#" class="button">Acción</a> Botón opcional -->
        </div>
        <div class="email-footer">
            <p>Gracias por tu atención.</p>
            <p>Para más información, visita nuestro <a href="#">sitio web</a>.</p>
            <p>&copy; {{ date('Y') }} Sistema de Reservas. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
