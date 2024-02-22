
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>LISTA DE PROPIETARIOS</h1>

                                 <div class="float-right">
                                <a href="{{ route('propietarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('NUEVO') }}
                                </a>
                              </div>
@stop

@section('content')
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>NIT</th>
                <th>NOMBRE TRANSPORTE date</th>
                <th>TELEFONO</th>
                <th>CORREO</th>
                <th>DIRECCION FISCAL</th>
                <th>NO. VEHICULO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
                                                @foreach ($propietarios as $propietario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $propietario->nombre }}</td>
											<td>{{ $propietario->dpi }}</td>
											<td>{{ $propietario->nit }}</td>
											<td>{{ $propietario->nombre_transporte }}</td>
											<td>{{ $propietario->telefono }}</td>
											<td>{{ $propietario->correo }}</td>
											<td>{{ $propietario->direccion_fiscal }}</td>
											<td>{{ $propietario->no_vehiculo }}</td>

                                            <td>
                                                <form action="{{ route('propietarios.destroy',$propietario->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('propietarios.show',$propietario->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('propietarios.edit',$propietario->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar </button>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js">  </script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js">  </script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js">  </script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js">  </script>

    <script>
        $('#example').DataTable( {
          responsive:true
        } );
    </script>
@stop





















