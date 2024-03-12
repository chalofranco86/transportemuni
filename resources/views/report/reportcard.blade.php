<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportee</title>
    <style>
        body {
            margin: 50px; /* Adjust the margin as needed */
            font-family: 'Arial', sans-serif; /* Change the font family */
        }

        .info-container {
            max-width: 50%;
            margin: 0 auto; /* Center the container */
            float: left;
            border: 1px solid #ccc; /* Add a border to the info container */
            padding: 10px; /* Add padding for better readability */
        }

        .photo-container {
            max-width: 30%;
            float: right;
            text-align: center; /* Center the content inside the photo container */
        }

        .photo-container img {
            max-width: 100%;
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
        <img src="{{ public_path('vendor/adminlte/dist/img/transportelogo.jpeg') }}" alt="Logo" style="width: 160px; height: auto;">
    </div>

    <h1>             TARJETA PILOTO</h1>
    
    <div class="photo-container">
        <strong>Foto Piloto:</strong>
        @if ($card->foto_piloto && Storage::disk('public')->exists($card->foto_piloto))
            <img src="{{ public_path('storage/' . $card->foto_piloto) }}" alt="Foto Piloto" />
        @else
            No hay foto del piloto
        @endif
    </div>

    <div class="info-container">
        <p><strong>Nombre Piloto:</strong> {{ $card->nombre_piloto }}</p>
        <p><strong>Direccion Piloto:</strong> {{ $card->direccion_piloto }}</p>
        <p><strong>Correo Piloto:</strong> {{ $card->correo_piloto }}</p>
        <p><strong>Telefono Piloto:</strong> {{ $card->telefono_piloto }}</p>
        <p><strong>Tipo Licencia:</strong> {{ $card->tipo_licencia }}</p>
        <p><strong>Vehiculo Asociado:</strong> {{ $card->vehi->nombre_vehi }}</p>

        <!-- Agrega los campos adicionales que necesitas -->

        <p><strong>Fecha Emision:</strong> {{ $card->fecha_emision }}</p>
        <p><strong>Fecha Vencimiento:</strong> {{ $card->fecha_vencimiento }}</p>
    </div>
</body>
</html>
