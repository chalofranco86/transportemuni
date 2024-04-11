<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitácora PDF</title>
</head>
<body>
    <h1>Bitácora</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bitacora as $registro)
            <tr>
                <td>{{ $registro->id }}</td>
                <td>{{ $registro->user_id }}</td>
                <td>{{ $registro->descripcion }}</td>
                <td>{{ $registro->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>