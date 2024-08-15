@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pilotos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Create') }} Card</span>
                </div>
                <div class="card-body">
                    <form id="cardsForm" method="POST" action="{{ route('cards.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        @include('card.form')

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            <a class="btn btn-danger" href="{{ route('cards.index') }}">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    document.getElementById('cardsForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var nombreCard = document.querySelector('input[name="nombre_piloto"]').value;
        var direccionCard = document.querySelector('input[name="direccion_piloto"]').value;
        var correoCard = document.querySelector('input[name="correo_piloto"]').value;
        var telefonoCard = document.querySelector('input[name="telefono_piloto"]').value;
        var tipoLicencia = document.querySelector('select[name="tipo_licencia"]').value;
        var licencia = document.querySelector('input[name="licencia"]').value;
        var fotoPiloto = document.querySelector('input[name="foto_piloto"]').value;
        var dpiPiloto = document.querySelector('input[name="dpi_piloto"]').value;
        var antecedentesPenales = document.querySelector('input[name="antecedentes_penales"]').value;
        var antecedentesPoliciacos = document.querySelector('input[name="antecedentes_policiacos"]').value;
        var Renas = document.querySelector('input[name="renas"]').value;
        var BoletoOrnato = document.querySelector('input[name="boleto_ornato"]').value;
        var numeroVehiculoId = document.querySelector('select[name="numero_vehiculo_id"]').value;

        if (confirm('¿Estás seguro de que quieres guardar estos datos?\n\n' +
                    'Nombre del Piloto: ' + nombreCard + '\n' +
                    'Dirección: ' + direccionCard + '\n' +
                    'Correo: ' + correoCard + '\n' +
                    'Teléfono: ' + telefonoCard + '\n' +
                    'Tipo de licencia: ' + tipoLicencia + '\n' +
                    'Licencia: ' + licencia + '\n' +
                    'Foto del Piloto: ' + fotoPiloto + '\n' +
                    'DPI del Piloto: ' + dpiPiloto + '\n' +
                    'Antecedentes Penales: ' + antecedentesPenales + '\n' +
                    'Antecedentes Policiacos: ' + antecedentesPoliciacos + '\n' +
                    'Renas: ' + Renas + '\n' +
                    'Boleto de Ornato: ' + BoletoOrnato + '\n' +
                    'Número de Vehículo: ' + numeroVehiculoId)) {
            this.submit();
        }
    });
</script>
@endsection