@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>TARJETA PILOTO</h1>

    <div class="float-right">
        <a href="{{ route('cards.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
            {{ __('Create New') }}
        </a>
    </div>
@stop

@section('content')
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
                <th>Foto Piloto IMAGEN</th>
                <th>DPI Piloto IMAGEN</th>
                <th>Fecha Emision</th>
                <th>Fecha Vencimiento</th>
                <th>Antecedentes Penales</th>
                <th>Antecedentes Policiacos</th>
                <th>Renas</th>
                <th>Boleto Ornato</th>
                <th>Numero Vehiculo Id</th>
                <th>ID Propietario de Vehiculo</th>
                <th>Acciones</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cards as $card)
                <tr>
                    <td>{{ ++$i }}</td>
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
                    <td>{{ $card->propietario_id }}</td>
                    <td>
                        <form action="{{ route('cards.destroy',$card->id) }}" method="POST">
                            <a class="btn btn-sm btn-primary " href="{{ route('cards.show',$card->id) }}">
                                <i class="fa fa-fw fa-eye"></i> {{ __('Show') }}
                            </a>
                            <a class="btn btn-sm btn-success" href="{{ route('cards.edit',$card->id) }}">
                                <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('cards.update_status', $card->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="estado_card" onchange="this.form.submit()">
                                <option value="INACTIVO" {{ $card->estado_card == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                                <option value="ACTIVO" {{ $card->estado_card == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
@stop