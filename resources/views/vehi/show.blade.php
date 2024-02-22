@extends('adminlte::page')

@section('title', 'Show Vehi')

@section('content_header')
    <h1>{{ __('Show') }} Vehi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Vehi</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('vehis.index') }}">{{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <strong>Nombre Vehi:</strong>
                        {{ $vehi->nombre_vehi }}
                    </div>
                    <div class="form-group">
                        <strong>Placa Vehi:</strong>
                        {{ $vehi->placa_vehi }}
                    </div>
                    <div class="form-group">
                        <strong>Tarjeta Circulacion:</strong>
                        @if ($vehi->tarjeta_circulacion)
                            <object data="{{ asset('storage/' . $vehi->tarjeta_circulacion) }}" type="application/pdf" width="100%" height="600px">
                                <p>Este navegador no puede mostrar el archivo PDF. Puedes <a href="{{ asset('storage/' . $vehi->tarjeta_circulacion) }}" target="_blank">descargarlo</a> en su lugar.</p>
                            </object>
                        @else
                            No hay archivo adjunto
                        @endif
                    </div>
                    <div class="form-group">
                        <strong>Titulo Propiedad:</strong>
                        @if ($vehi->titulo_propiedad)
                            <object data="{{ asset('storage/' . $vehi->titulo_propiedad) }}" type="application/pdf" width="100%" height="600px">
                                <p>Este navegador no puede mostrar el archivo PDF. Puedes <a href="{{ asset('storage/' . $vehi->titulo_propiedad) }}" target="_blank">descargarlo</a> en su lugar.</p>
                            </object>
                        @else
                            No hay archivo adjunto
                        @endif
                    </div>
                    <div class="form-group">
                        <strong>Tipo Vehi:</strong>
                        {{ $vehi->tipo_vehi }}
                    </div>
                    <div class="form-group">
                        <strong>Numero Ruta Id:</strong>
                        {{ $vehi->numero_ruta_id }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
