<!DOCTYPE html>
<html>
<head>
    <title>Informe de Vehículos</title>
    <!-- Estilos personalizados si es necesario -->
</head>
<body>
    <h1>Informe de Vehículos</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID Vehículo</th>
                <th>Nombre</th>
                <!-- Agrega más columnas según sea necesario -->
            </tr>
        </thead>
        <tbody>
            @foreach($vehi as $vehi)
                <tr>
                    <td>{{ $vehi->id }}</td>
                    <td>{{ $vehi->nombre_vehiculo }}</td>
                    <!-- Agrega más columnas según sea necesario -->
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
