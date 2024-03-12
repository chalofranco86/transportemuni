<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Vehículos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilos para la imagen en la esquina superior derecha */
        .logo-container {
            position: absolute;
            top: 20px; /* Ajusta la posición desde la parte superior */
            right: 20px; /* Ajusta la posición desde la derecha */
        }
    </style>
</head>
<body>
    <!-- Contenedor para la imagen en la esquina superior derecha -->
    <div class="logo-container">
        <img src="{{ public_path('vendor/adminlte/dist/img/transportelogo.jpeg') }}" alt="Logo" style="width: 100px; height: auto;">
    </div>

    <h1>LISTA VEHÍCULOS</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehículo</th>
                <th>Placa</th>
                <th>Tarjeta Circulación</th>
                <th>Título de Propiedad</th>
                <th>Tipo</th>
                <th>Ruta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehis as $vehi)
                <tr>
                    <td>{{ $vehi->id }}</td>
                    <td>{{ $vehi->nombre_vehi }}</td>
                    <td>{{ $vehi->placa_vehi }}</td>
                    <td>{{ $vehi->tarjeta_circulacion ? 'Sí' : 'No' }}</td>
                    <td>{{ $vehi->titulo_propiedad ? 'Sí' : 'No' }}</td>
                    <td>{{ $vehi->tipo_vehi }}</td>
                    <td>{{ $vehi->numero_ruta_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>