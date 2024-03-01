@extends('adminlte::page')

@section('title', 'ShowPropietario')

@section('content_header')
    <h1>{{ __('MOSTRAR') }} PROPIETARIO</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('propio.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Nombre Propietario:</strong>
                            {{ $propio->nombre_propietario }}
                        </div>
                        <div class="form-group">
                            <strong>Dpi Propietario:</strong>
                            @if (Str::endsWith($propio->dpi_propietario, '.pdf'))
                                <embed src="{{ asset('storage/' . $propio->dpi_propietario) }}" type="application/pdf" width="100%" height="600px" />
                            @else
                                {{ $propio->dpi_propietario }}
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Nit Propietario:</strong>
                            {{ $propio->nit_propietario }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono Propietario:</strong>
                            {{ $propio->telefono_propietario }}
                        </div>
                        <div class="form-group">
                            <strong>Correo Propietario:</strong>
                            {{ $propio->correo_propietario }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion Fiscal:</strong>
                            {{ $propio->direccion_fiscal }}
                        </div>
                        <div class="form-group">
                            <strong>Vehiculos Asociados:</strong>
                            @if(is_array($propio->vehiculos_asociados))
                                @foreach ($propio->vehiculos_asociados as $vehi_id)
                                    {{ \App\Models\Vehi::find($vehi_id)->nombre_vehi }}
                                    @if (!$loop->last)
                                        , <!-- Agrega una coma si no es el último vehículo -->
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Nombre Empresa:</strong>
                            {{ $propio->nombre_empresa }}
                        </div>
                        <div class="form-group">
                            <strong>Nit Empresa:</strong>
                            {{ $propio->nit_empresa }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
