@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>vehiculos</h1>

        <div class="float-right">
        <a href="{{ route('vehiculos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
            {{ __('NUEVO') }}
        </a>
    </div>
@stop

@section('content')
    
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>nombre_vehiculo</th>
                <th>PLACA</th>
                <th>TARJETA</th>
                <th>TITULO</th>
                <th>TIPO</th>
                <th>RUTA</th>
                <th>PILOTO</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($vehiculos as $vehiculo)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $vehiculo->nombre_vehiculo }}</td>
                <td>{{ $vehiculo->placa_vehiculo }}</td>
                <td>
                    @if ($vehiculo->tarjeta_circulacion)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td>
                    @if ($vehiculo->titulo_propiedad)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td>{{ $vehiculo->tipo_vehiculo }}</td>
                <td>{{ $vehiculo->ruta->numero_ruta }}</td>
                <td>{{ $vehiculo->tarjetapiloto->nombre_piloto }}</td>
                <td>
                    <form action="{{ route('vehiculos.destroy',$vehiculo->id) }}" method="POST">
                        <a class="btn btn-sm btn-primary " href="{{ route('vehiculos.show',$vehiculo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                        <a class="btn btn-sm btn-success" href="{{ route('vehiculos.edit',$vehiculo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop





