
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre_piloto') }}
            {{ Form::text('nombre_piloto', $card->nombre_piloto, ['class' => 'form-control' . ($errors->has('nombre_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Piloto']) }}
            {!! $errors->first('nombre_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('direccion_piloto') }}
            {{ Form::text('direccion_piloto', $card->direccion_piloto, ['class' => 'form-control' . ($errors->has('direccion_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Direccion Piloto']) }}
            {!! $errors->first('direccion_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            {{ Form::label('correo_piloto') }}
            {{ Form::text('correo_piloto', $card->correo_piloto, ['class' => 'form-control' . ($errors->has('correo_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Correo Piloto']) }}
            {!! $errors->first('correo_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('telefono_piloto') }}
            {{ Form::text('telefono_piloto', $card->telefono_piloto, ['class' => 'form-control' . ($errors->has('telefono_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Piloto']) }}
            {!! $errors->first('telefono_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('tipo_licencia', 'Tipo de Licencia') }}
            {{ Form::select('tipo_licencia', ['A' => 'A', 'B' => 'B'], $card->tipo_licencia, [
                'class' => 'form-control' . ($errors->has('tipo_licencia') ? ' is-invalid' : ''),
                'placeholder' => 'Seleccionar Tipo de Licencia'
            ]) }}
            {!! $errors->first('tipo_licencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('licencia') }}
            @if($card->licencia)
                <div>
                    <a href="{{ $card->licencia }}">Ver licencia actual</a>
                </div>
            @endif
            {{ Form::file('licencia', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('licencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('foto_piloto') }}
            @if($card->foto_piloto)
                <div>
                    <a href="{{ $card->foto_piloto }}">Ver fotografia actual</a>
                </div>
            @endif
            {{ Form::file('foto_piloto', ['class' => 'form-control-file']) }}
            <p>IMAGEN</p>
            {!! $errors->first('foto_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group" >
            {{ Form::label('dpi_piloto')  }}
            @if($card->dpi_piloto)
                <div>
                    <a href="{{ $card->dpi_piloto }}">Ver DPI actual</a>
                </div>
            @endif
            {{ Form::file('dpi_piloto', ['class' => 'form-control-file']) }}
            <p>IMAGEN</p>
            {!! $errors->first('dpi_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('fecha_emision') }}
            {{ Form::date('fecha_emision', $card->fecha_emision, ['class' => 'form-control' . ($errors->has('fecha_emision') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Emision']) }}
            {!! $errors->first('fecha_emision', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_vencimiento') }}
            {{ Form::date('fecha_vencimiento', $card->fecha_vencimiento, ['class' => 'form-control' . ($errors->has('fecha_vencimiento') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Vencimiento']) }}
            {!! $errors->first('fecha_vencimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('no_pago') }}
            {{ Form::text('no_pago', $card->no_pago, ['class' => 'form-control' . ($errors->has('no_pago') ? ' is-invalid' : ''), 'placeholder' => 'No. Boleta de Pago']) }}
            {!! $errors->first('no_pago', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('antecedentes_penales') }}
                @if($card->antecedentes_penales)
                    <div>
                        <a href="{{ $card->antecedentes_penales }}">Ver Antecede Penal actual</a>
                    </div>
                @endif
            {{ Form::file('antecedentes_penales', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('antecedentes_penales', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('antecedentes_policiacos') }}
            @if($card->antecedentes_policiacos)
                <div>
                    <a href="{{ $card->antecedentes_policiacos }}">Ver Antecedente Policiaco actual</a>
                </div>
            @endif
            {{ Form::file('antecedentes_policiacos', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('antecedentes_policiacos', '<div class="invalid-feedback">:message</div>') !!}
        </div>        

        <div class="form-group">
            {{ Form::label('renas') }}
            @if($card->renas)
                <div>
                    <a href="{{ $card->renas }}">Ver RENAS actual</a>
                </div>
            @endif
            {{ Form::file('renas', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('renas', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('boleto_ornato') }}
            @if($card->boleto_ornato)
                <div>
                    <a href="{{ $card->boleto_ornato }}">Ver BOLETO ORNATO actual</a>
                </div>
            @endif
            {{ Form::file('boleto_ornato', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('boleto_ornato', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Campo para seleccionar un vehículo existente -->
            <div class="form-group">
                {{ Form::label('propietario_id', 'Seleccionar Propietarios') }}
                {{ Form::select('propietario_id', $propio, null, ['class' => 'form-control propietario-select', 'placeholder' => 'Seleccionar Propietario']) }}
                {!! $errors->first('propietario_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                {{ Form::label('numero_vehiculo_id') }}
                {{ Form::select('numero_vehiculo_id', $vehi, $card->numero_vehiculo_id, ['class' => 'form-control vehiculo-select' . ($errors->has('numero_vehiculo_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar Vehículo']) }}
                {!! $errors->first('numero_vehiculo_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>

    </div>
</div>

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.propietario-select').select2({
                placeholder: 'Seleccionar Propietario',
                allowClear: true
            });
            $('.vehiculo-select').select2({
                placeholder: 'Seleccionar Vehículo',
                allowClear: true
            });
        });
    </script>
    <script> console.log('Hi!'); </script>
@stop