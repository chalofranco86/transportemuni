@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tarjeta Piloto</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Tarjetapiloto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tarjetapilotos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre Piloto:</strong>
                            {{ $tarjetapiloto->nombre_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Dpi Piloto:</strong>
                            {{ $tarjetapiloto->dpi_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Licencia Piloto:</strong>
                            {{ $tarjetapiloto->tipo_licencia_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Fotografia Piloto:</strong>
                            @if ($tarjetapiloto->fotografia_piloto)
                                <img class="thumbnail" src="{{ asset('storage/images/' . $tarjetapiloto->fotografia_piloto) }}" alt="Fotografía">
                            @else
                                <span>No se cargó imagen</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Fecha Emision Piloto:</strong>
                            {{ $tarjetapiloto->fecha_emision_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Vencimiento Piloto:</strong>
                            {{ $tarjetapiloto->fecha_vencimiento_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion Piloto:</strong>
                            {{ $tarjetapiloto->direccion_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono Piloto:</strong>
                            {{ $tarjetapiloto->telefono_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Correo Piloto:</strong>
                            {{ $tarjetapiloto->correo_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Fotografia Antecedentes:</strong>
                            @if ($tarjetapiloto->antecedentes_penales_piloto)
                                <img class="thumbnail" src="{{ asset('storage/images/' . $tarjetapiloto->antecedentes_penales_piloto) }}" alt="AP">
                            @else
                                <span>No se cargó imagen</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Antecedentes Policiacos:</strong>
                            @if ($tarjetapiloto->antecedentes_policiacos_piloto)
                                <img class="thumbnail" src="{{ asset('storage/images/' . $tarjetapiloto->antecedentes_policiacos_piloto) }}" alt="APoli">
                            @else
                                <span>No se cargó imagen</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Foto Licencia Piloto:</strong>
                            {{ $tarjetapiloto->foto_licencia_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Renas Piloto:</strong>
                            {{ $tarjetapiloto->renas_piloto }}
                        </div>
                        <div class="form-group">
                            <strong>Boleto Ornato Piloto:</strong>
                            {{ $tarjetapiloto->boleto_ornato_piloto }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
