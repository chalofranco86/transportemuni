@extends('adminlte::page')

@section('title', __('NUEVO PROPIETARIO'))

@section('content_header')
    <h1>{{ __('CREAR') }} PROPIETARIO</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Nuevo') }} Propietario</span>
                    </div>
                    <div class="card-body">
                        <form id="propioForm" method="POST" action="{{ route('propio.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('propio.form')
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{ __('CREAR') }}</button>
                                <a class="btn btn-danger" href="{{ route('propio.index') }}">{{ __('Cancelar') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 

        <script>
        document.getElementById('propioForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var nombrePropietario = document.querySelector('input[name="nombre_propietario"]').value;
            var dpiPropietario = document.querySelector('input[name="dpi_propietario"]').value;
            var nitPropietario = document.querySelector('input[name="nit_propietario"]').value;
            var telefonoPropietario = document.querySelector('input[name="telefono_propietario"]').value;
            var correoPropietario = document.querySelector('input[name="correo_propietario"]').value;
            var direccionFiscal = document.querySelector('input[name="direccion_fiscal"]').value;
            var nombreEmpresa = document.querySelector('input[name="nombre_empresa"]').value;
            var nitEmpresa = document.querySelector('input[name="nit_empresa"]').value;

            if (confirm('¿Estás seguro de que quieres guardar estos datos?\n\n' +
                        'Nombre del Propietario: ' + nombrePropietario + '\n' +
                        'DPI del Propietario: ' + dpiPropietario + '\n' +
                        'NIT del Propietario: ' + nitPropietario + '\n' +
                        'Teléfono del Propietario: ' + telefonoPropietario + '\n' +
                        'Correo del Propietario: ' + correoPropietario + '\n' +
                        'Dirección Fiscal: ' + direccionFiscal + '\n' +
                        'Nombre de la Empresa: ' + nombreEmpresa + '\n' +
                        'NIT de la Empresa: ' + nitEmpresa)) {
                this.submit();
            }
        });
    </script>

    </section>

@endsection
