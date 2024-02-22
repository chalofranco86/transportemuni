<!DOCTYPE html>
<html>
<head>
    <title>Informe de Pilotos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }
    </style>
</head>
<body>
    <h1>Informe de Pilotos</h1>

    <table>
        <thead>
            <tr>
                <th>Id Piloto</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>Tipo Licencia</th>
                <th>Fotografía</th>
                <th>Fecha Emisión</th>
                <th>Fecha Vencimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tarjetapilotos as $tarjetapiloto)
                <tr>
                    <td>{{ $tarjetapiloto->id }}</td>
                    <td>{{ $tarjetapiloto->nombre_piloto }}</td>
                    <td>{{ $tarjetapiloto->dpi_piloto }}</td>
                    <td>{{ $tarjetapiloto->tipo_licencia_piloto }}</td>
                    <td>{{ $tarjetapiloto->fotografia_piloto }}</td>
                    <td>{{ $tarjetapiloto->fecha_emision_piloto }}</td>
                    <td>{{ $tarjetapiloto->fecha_vencimiento_piloto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
