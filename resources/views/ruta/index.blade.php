
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>LISTA RUTAS</h1>

        <div class="float-right">
            <a href="{{ route('rutas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                {{ __('NUEVO') }}
            </a>
            <a href="{{ route('report.reportrutastable') }}" class="btn btn-info btn-sm float-right" style="margin-right: 10px;">
            <i class="fa fa-fw fa-file-pdf"></i> {{ __('Generate All PDF') }}
            </a>
        </div>
@stop

@section('content')
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID RUTA</th>
                <th>NOMBRE</th>
                <th>RUTA</th>
                <th>ACCIONES</th>

            </tr>
        </thead>
        <tbody>
                                    @foreach ($rutas as $ruta)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ruta->nombre_ruta }}</td>
											<td>{{ $ruta->numero_ruta }}</td>

                                            <td>
                                                <form action="{{ route('rutas.destroy',$ruta->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('rutas.show',$ruta->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('rutas.edit',$ruta->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    @if (in_array(auth()->user()->role, ['superadmin']	))
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
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
        $('#example').DataTable( {
          responsive:true
        } );
    </script>
@stop





