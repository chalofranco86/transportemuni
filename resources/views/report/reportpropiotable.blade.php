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
            padding: 4px; /* Reducir el padding */
            text-align: left;
            font-size: 12px; /* Ajustar el tamaño del texto */
        }

        th {
            background-color: #f2f2f2;
        }
         
        body {
            margin: 10px; /* Ajusta este valor según tus necesidades */
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

    <h1>PROPIETARIOS</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre Propietario</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Direccion</th>
                <th>Nit Propietario</th>
                <th>ID Vehiculos Asociados</th>
                <th>Empresa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($propios as $propio)
                <tr>
                    <td>{{ $propio->nombre_propietario }}</td>
                    <td>{{ $propio->telefono_propietario }}</td>
                    <td>{{ $propio->correo_propietario }}</td>
                    <td>{{ $propio->direccion_fiscal }}</td>
                    <td>{{ $propio->nit_propietario }}</td>
                    <td>
                                                @php
                                                    $vehiculosAsociados = json_decode($propio->vehiculos_asociados, true);
                                                @endphp

                                                @if (is_array($vehiculosAsociados) && count($vehiculosAsociados) > 0)
                                                    @foreach ($vehiculosAsociados as $conjuntoVehiculos)
                                                        @if (is_array($conjuntoVehiculos))
                                                            {{ implode(', ', $conjuntoVehiculos) }}
                                                        @else
                                                            {{ $conjuntoVehiculos }}
                                                        @endif
                                                        @if (!$loop->last)
                                                            , <!-- Agrega una coma si no es el último conjunto de vehículos -->
                                                        @endif
                                                    @endforeach
                                                @else
                                                    No hay vehículos asociados
                                                @endif
                        </td>
                    <td>{{ $propio->nombre_empresa }}</td>
                </tr>
            @endforeach
        </tbody>
        </tbody>
    </table>
</body>
</html>