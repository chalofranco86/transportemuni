@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>LISTA VEHICULOS</h1>
    <div class="float-right">
        @if (in_array(auth()->user()->role, ['superadmin', 'admin']))
            <a href="{{ route('vehis.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                {{ __('Nuevo') }}
            </a>
            <a href="{{ route('report.reportvehitable') }}" class="btn btn-info btn-sm float-right" style="margin-right: 10px;">
                <i class="fa fa-fw fa-file-pdf"></i> {{ __('Generate All PDF') }}
            </a>
        @endif
    </div>
@stop

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No Vehiculo</th>
                <th>Vehiculo</th>
                <th>Placa</th>
                <th>Tarjeta Circulacion</th>
                <th>Titulo de Propiedad</th>
                <th>Tipo</th>
                <th>Ruta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehis as $vehi)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $vehi->nombre_vehi }}</td>
                    <td>{{ $vehi->placa_vehi }}</td>
                    <td>{{ $vehi->tarjeta_circulacion ? 'Sí' : 'No' }}</td>
                    <td>{{ $vehi->titulo_propiedad ? 'Sí' : 'No' }}</td>
                    <td>{{ $vehi->tipo_vehi }}</td>
                    <td>{{ $vehi->numero_ruta_id }}</td>
                    <td>
                        <form action="{{ route('vehis.eliminar', $vehi->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if (in_array(auth()->user()->role, ['superadmin', 'admin', 'propietario']))
                                <a class="btn btn-sm btn-primary" href="{{ route('vehis.show', $vehi->id) }}">
                                    <i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}
                                </a>
                            @endif
                            @if (in_array(auth()->user()->role, ['superadmin', 'admin']))
                                <a class="btn btn-sm btn-success" href="{{ route('vehis.edit', $vehi->id) }}">
                                    <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este vehículo?');">
                                    <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}
                                </button>
                            @endif
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