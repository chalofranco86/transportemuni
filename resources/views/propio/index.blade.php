@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>LISTA PROPIETARIOS CREADOS</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Propio') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('propio.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                                <a href="{{ route('report.reportpropiotable') }}" class="btn btn-info btn-sm float-right" style="margin-right: 10px;">
                                    <i class="fa fa-fw fa-file-pdf"></i> {{ __('All PDF') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre Propietario</th>
                                        <th>Dpi Propietario</th>
                                        <th>Nit Propietario</th>
                                        <th>Telefono Propietario</th>
                                        <th>Correo Propietario</th>
                                        <th>Direccion Fiscal</th>
                                        <th>Numero Vehiculos Asociados</th>
                                        <th>Vehiculos Asociados</th>
                                        <th>Nombre Empresa</th>
                                        <th>Nit Empresa</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($propios as $propio)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $propio->nombre_propietario }}</td>
                                            <td>
                                                @if ($propio->dpi_propietario)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            </td>
                                            <td>{{ $propio->nit_propietario }}</td>
                                            <td>{{ $propio->telefono_propietario }}</td>
                                            <td>{{ $propio->correo_propietario }}</td>
                                            <td>{{ $propio->direccion_fiscal }}</td>
                                            <td>{{ is_array(json_decode($propio->vehiculos_asociados)) ? count(json_decode($propio->vehiculos_asociados)) : 0 }}</td>
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
                                            <td>{{ $propio->nit_empresa }}</td>
                                            <td>
                                                <form action="{{ route('propio.destroy',$propio->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('propio.show',$propio->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Show') }}
                                                    </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('propio.edit',$propio->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
