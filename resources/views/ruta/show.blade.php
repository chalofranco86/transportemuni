@extends('adminlte::page')

@section('title', 'Detalle Ruta')

@section('content_header')
    <h1>Detalle Ruta</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-6"> <!-- Utilizamos col-md-6 para que ocupe la mitad del espacio en pantallas medianas y grandes -->
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Ruta</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rutas.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Nombre Ruta:</strong>
                            {{ $ruta->nombre_ruta }}
                        </div>
                        <div class="form-group">
                            <strong>Numero Ruta:</strong>
                            {{ $ruta->numero_ruta }}
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
