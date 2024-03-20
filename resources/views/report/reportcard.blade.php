<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportee</title>
    <style>
        body {
            margin: 20px; /* Ajustar el margen según sea necesario */
            font-family: 'Arial', sans-serif; /* Cambiar la familia de fuentes */
            font-size: 10px; /* Cambiar el tamaño de la fuente */
        }

        .info-container {
            max-width: 70%; /* Ajustar el ancho máximo */
            margin-right: 30px; /* Ajustar el margen derecho para separar del contenedor de la foto */
            border: 1px solid #ccc; /* Agregar un borde al contenedor de información */
            padding: 5px; /* Agregar relleno para una mejor legibilidad */
            float: left; /* Mover el contenedor de información a la izquierda */
        }

        .photo-container {
            max-width: 20%; /* Ajustar el ancho máximo */
            float: left; /* Mover el contenedor de la foto a la izquierda */
            text-align: center; /* Centrar el contenido dentro del contenedor de la foto */
        }

        .photo-container img {
            max-width: 100%; /* Asegurar que la imagen no supere el ancho del contenedor */
        }

        /* Estilos para la imagen en la esquina superior derecha */
        .logo-container {
            position: absolute;
            top: 165px; /* Ajustar la posición desde la parte superior */
            right: 515px; /* Ajustar la posición desde la derecha */
            opacity: 0.2; /* Ajustar la opacidad de la imagen para dar el efecto de marca de agua */
        }
    </style>
</head>
<body>

    <!-- Contenedor para la imagen en la esquina superior derecha -->
    <div class="logo-container">
        <img src="{{ public_path('vendor/adminlte/dist/img/transportelogo.jpeg') }}" alt="Logo" style="width: 160px; height: auto;">
    </div>

    <h1>   </h1>
    
    <div class="photo-container">
      
        @if ($card->foto_piloto && Storage::disk('public')->exists($card->foto_piloto))
            <img src="{{ public_path('storage/' . $card->foto_piloto) }}" alt="Foto Piloto" />
        @else
            No hay foto del piloto
        @endif
    </div>

    <div class="info-container">
        <p><strong>Nombre Piloto:</strong> {{ $card->nombre_piloto }}</p>
        <p><strong>Direccion Piloto:</strong> {{ $card->direccion_piloto }}</p>
        <p><strong>Tipo Licencia:</strong> {{ $card->tipo_licencia }}</p>
        <p><strong>Vehiculo Asociado:</strong> {{ $card->vehi->nombre_vehi }}</p>
        <p><strong>Estado:</strong> {{ $card->estado_card }}</p>
        <p><strong>Fecha Emision:</strong> {{ $card->fecha_emision }}</p>
        <p><strong>Fecha Vencimiento:</strong> {{ $card->fecha_vencimiento }}</p>
    </div>
</body>
</html>
