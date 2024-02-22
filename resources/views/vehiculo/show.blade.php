@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Vehiculo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('vehiculos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre Vehiculo:</strong>
                            {{ $vehiculo->nombre_vehiculo }}
                        </div>
                        <div class="form-group">
                            <strong>Placa Vehiculo:</strong>
                            {{ $vehiculo->placa_vehiculo }}
                        </div>
                        <div class="form-group">
                            <strong>Tarjeta Circulacion:</strong>
                            @if ($vehiculo->tarjeta_circulacion)
                                <embed src="{{ asset('storage/' . $vehiculo->tarjeta_circulacion) }}" type="application/pdf" width="100%" height="600px" />
                            @else
                                No hay archivo adjunto
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Titulo Propiedad:</strong>
                            @if ($vehiculo->titulo_propiedad)
                                <embed src="{{ asset('storage/' . $vehiculo->titulo_propiedad) }}" type="application/pdf" width="100%" height="600px" />
                            @else
                                No hay archivo adjunto
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Tipo Vehiculo:</strong>
                            {{ $vehiculo->tipo_vehiculo }}
                        </div>
                        <div class="form-group">
                            <strong>Numero Ruta Id:</strong>
                            {{ $vehiculo->numero_ruta_id }}
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
