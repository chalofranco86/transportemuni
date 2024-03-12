<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertir Imagen a PDF</title>
</head>
<body>
    <h1>Convertir Imagen a PDF</h1>

    @if ($errors->any())
        <div>
            <strong>¡Ups! Hubo algunos problemas con tu solicitud:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('convertir.imagen') }}" method="POST" enctype="multipart/form-data">                                         
        @csrf
        <div>
            <label for="image">Selecciona una imagen:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Convertir a PDF</button>
    </form>
</body>
</html>