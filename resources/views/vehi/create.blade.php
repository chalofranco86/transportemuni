@extends('adminlte::page')

@section('title', __('NUEVO Vehiculo'))

@section('content_header')
    <h1>{{ __('Crear') }} Vehiculo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ __('NUEVO') }} VEHICULO</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('vehis.store') }}" role="form" enctype="multipart/form-data" id="vehiForm">
                        @csrf

                        @include('vehi.form')

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Crear') }}</button>
                            <a class="btn btn-danger" href="{{ route('vehis.index') }}">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // document.getElementById('vehiForm').addEventListener('submit', function(event) {
        //     event.preventDefault();
        //     var nombreVehi = document.querySelector('input[name="nombre_vehi"]').value;
        //     var placaVehi = document.querySelector('input[name="placa_vehi"]').value;
        //     var TarjetCirculacion = document.querySelector('input[name="tarjeta_circulacion"]').value;
        //     var TituloPropiedad = document.querySelector('input[name="titulo_propiedad"]').value;
        //     var tipoVehi = document.querySelector('select[name="tipo_vehi"]').value;
        //     var numeroRutaId = document.querySelector('input[name="numero_ruta_id"]').value;
        //     if (confirm('¿Estás seguro de que quieres guardar estos datos?\n\n' +
        //                 'Nombre del vehículo: ' + nombreVehi + '\n' +
        //                 'Placa del vehículo: ' + placaVehi + '\n' +
        //                 'Tarjeta de Circulación: ' + TarjetCirculacion + '\n' +
        //                 'Título de Propiedad: ' + TituloPropiedad + '\n' +
        //                 'Tipo de vehículo: ' + tipoVehi + '\n' +
        //                 'Número de ruta: ' + numeroRutaId)) {
        //         this.submit();
        //     }
        // });
    </script>
@endsection
