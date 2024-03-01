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


    <table>
        <tr>
        <h1>LISTA RUTAS</h1>
        </tr>
        <thead>
            <tr>
                <th>NOMBRE RUTA</th>
                <th>NO. RUTA</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($rutas as $ruta)
                <tr>
                    <td>{{ $ruta->nombre_ruta }}</td>
                    <td>{{ $ruta->numero_ruta }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>