@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pilotos</h1>
                                 <div class="float-right">
                                <a href="{{ route('tarjetapilotos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
@stop

@section('content')
    
    
    <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>DPI</th>
                    <th>Licencia</th>
                    <th>Fotografia</th>
                    <th>Fecha Emision</th>
                    <th>Fecha Vencimiento</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Antecedentes Penales</th>
                    <th>Antecedentes Policiacos</th>
                    <th>Foto Licencia</th>
                    <th>Renas</th>
                    <th>Boleto Ornato</th>

                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarjetapiloto as $tarjetapiloto)
                                        <tr>
                                           
                                            
											<td>{{ $tarjetapiloto->nombre_piloto }}</td>
											<td>{{ $tarjetapiloto->dpi_piloto }}</td>
											<td>{{ $tarjetapiloto->tipo_licencia_piloto }}</td>
											<td>
                                                @if ($tarjetapiloto->fotografia_piloto)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            </td>
											<td>{{ $tarjetapiloto->fecha_emision_piloto }}</td>
											<td>{{ $tarjetapiloto->fecha_vencimiento_piloto }}</td>
											<td>{{ $tarjetapiloto->direccion_piloto }}</td>
											<td>{{ $tarjetapiloto->telefono_piloto }}</td>
											<td>{{ $tarjetapiloto->correo_piloto }}</td>
											<td>
                                                @if ($tarjetapiloto->antecedentes_penales_piloto)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            </td>
											<td>
                                                @if ($tarjetapiloto->antecedentes_policiacos_piloto)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            </td>
											<td>
                                                @if ($tarjetapiloto->foto_licencia_piloto)
                                                        SI
                                                    @else
                                                        NO
                                                    @endif
                                            </td>
											<td>
                                                @if ($tarjetapiloto->renas_piloto)
                                                        SI
                                                    @else
                                                        NO
                                                    @endif
                                            </td>
											<td>
                                                @if ($tarjetapiloto->boleto_ornato_piloto)
                                                        SI
                                                    @else
                                                        NO
                                                    @endif
                                            </td>

                                            <td>
                                                <form action="{{ route('tarjetapilotos.destroy',$tarjetapiloto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tarjetapilotos.show',$tarjetapiloto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tarjetapilotos.edit',$tarjetapiloto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
            </tbody>

    </table>

    <a href="{{ url('/generate-pdf') }}" class="btn btn-success btn-sm float-right"  data-placement="left">
        {{ __('Generar PDF') }}
    </a>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop





