<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
</head>
<body>
    @if ($card)
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nombre Piloto</th>
                <th>Direccion Piloto</th>
                <th>Correo Piloto</th>
                <th>Telefono Piloto</th>
                <th>Tipo de Licencia</th>
                <th>Foto Licencia</th>
                <th>Foto Piloto</th>
                <th>DPI Piloto</th>
                <th>Fecha Emision</th>
                <th>Fecha Vencimiento</th>
                <th>Antecedentes Penales</th>
                <th>Antecedentes Policiacos</th>
                <th>Renas</th>
                <th>Boleto Ornato</th>
                <th>Numero Vehiculo Id</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $card->nombre_piloto }}</td>
                <td>{{ $card->direccion_piloto }}</td>
                <td>{{ $card->correo_piloto }}</td>
                <td>{{ $card->telefono_piloto }}</td>
                <td>{{ $card->tipo_licencia }}</td>
                <td>{{ $card->licencia ? 'SI' : 'NO' }}</td>
                <td>{{ $card->foto_piloto ? 'SI' : 'NO' }}</td>
                <td>{{ $card->dpi_piloto ? 'SI' : 'NO' }}</td>
                <td>{{ $card->fecha_emision }}</td>
                <td>{{ $card->fecha_vencimiento }}</td>
                <td>{{ $card->antecedentes_penales ? 'SI' : 'NO' }}</td>
                <td>{{ $card->antecedentes_policiacos ? 'SI' : 'NO' }}</td>
                <td>{{ $card->renas ? 'SI' : 'NO' }}</td>
                <td>{{ $card->boleto_ornato ? 'SI' : 'NO' }}</td>
                <td>{{ $card->numero_vehiculo_id }}</td>
            </tr>
        </tbody>
    </table>
    @else
        <p>No se encontró la tarjeta</p>
    @endif
</body>
</html>
