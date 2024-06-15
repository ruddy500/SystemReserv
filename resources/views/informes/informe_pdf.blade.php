<!DOCTYPE html>
<html>
<head>
    <title>Informe de Uso de Ambientes Gestion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Informe de Uso de Ambientes</h2>
    <p>Gestión: {{ isset($configuraciones[0]->Gestion) ? $configuraciones[0]->Gestion : '1-20XX' }}</p>
    <table>
        <thead>
            <tr>
                <th>Ambiente</th>
                <th>Fecha</th>
                <th>Periodo</th>
                <th>Materia</th>
                <th>Motivo</th>
                <th>Docente</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item['nombreAmbiente'] }}</td>
                    <td>{{ $item['fecha'] }}</td>
                    <td>{{ $item['horaInicio'] }} - {{ $item['horaFin'] }}</td>
                    <td>{{ $item['nombreMateria'] }}</td>
                    <td>{{ $item['motivo'] }}</td>
                    <td>{{ $item['nombreDocente'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

 <!-- PONER AQUI AMBIENTES MAS USADO Y MENOS USADO -->
 <div class="Ambientemasusado">
    <label class="col-form-label">
        @if (isset($datos['ambienteMasUsado']) && !empty($datos['ambienteMasUsado']))
            Ambiente más usado: {{ $datos['ambienteMasUsado']['ambiente'] }}
            ({{ $datos['ambienteMasUsado']['cantidadApariciones'] }} 
                @if ($datos['ambienteMasUsado']['cantidadApariciones'] == 1)
                    vez asignado
                @else
                    veces asignado
                @endif
            )
        @else
            Ambiente más usado: No hay ambientes asignados
        @endif  
            
    </label>
</div>

<div class="Ambientemenosusado">
    <label class="col-form-label">
        @if (isset($datos['ambienteMenosUsado']) && !empty($datos['ambienteMenosUsado']))
            Ambiente menos usado: {{ $datos['ambienteMenosUsado']['ambiente'] }}
            ({{ $datos['ambienteMenosUsado']['cantidadApariciones'] }} 
                @if ($datos['ambienteMenosUsado']['cantidadApariciones'] == 1)
                    vez asignado
                @else
                    veces asignado
                @endif
            )
        @else
            Ambiente menos usado: No hay ambientes asignados
        @endif  
    
    </label>
</div>

</body>
</html>
