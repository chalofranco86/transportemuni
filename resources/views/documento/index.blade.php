
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>DOCUMENTOS REQ.</h1>

                                 <div class="float-right">
                                <a href="{{ route('documentos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuevo') }}
                                </a>
                              </div>
@stop

@section('content')
    
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Antecedentes Policiacos</th>
                <th>Antecedentes Penales</th>
                <th>RENAS</th>
                <th>Tipo Licencia</th>
                <th>DPI</th>
                <th>Boleto Ornato</th>
                <th>Direccion Fiscal</th>
                <th>Correo</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
@foreach ($documentos as $documento)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $documento->antecedentes_policiacos }}</td>
											<td>{{ $documento->antecedentes_penales }}</td>
											<td>{{ $documento->renas }}</td>
											<td>{{ $documento->licentia_tipo }}</td>
											<td>{{ $documento->dpi }}</td>
											<td>{{ $documento->boleto_ornato }}</td>
											<td>{{ $documento->direccion_fiscal }}</td>
											<td>{{ $documento->correo_documento }}</td>
											<td>{{ $documento->telefono_documento }}</td>

                                            <td>
                                                <form action="{{ route('documentos.destroy',$documento->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('documentos.show',$documento->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('documentos.edit',$documento->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
            
        </tfoot>
    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop











