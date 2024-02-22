@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Propietario</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Propietario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('propietarios.index') }}"> {{ __('Atras') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $propietario->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Dpi:</strong>
                            {{ $propietario->dpi }}
                        </div>
                        <div class="form-group">
                            <strong>Nit:</strong>
                            {{ $propietario->nit }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Transporte:</strong>
                            {{ $propietario->nombre_transporte }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $propietario->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $propietario->correo }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion Fiscal:</strong>
                            {{ $propietario->direccion_fiscal }}
                        </div>
                        <div class="form-group">
                            <strong>No Vehiculo:</strong>
                            {{ $propietario->no_vehiculo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

