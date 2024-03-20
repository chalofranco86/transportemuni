
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
            {{ Form::label('tipo_licencia') }}
            {{ Form::text('tipo_licencia', $card->tipo_licencia, ['class' => 'form-control' . ($errors->has('tipo_licencia') ? ' is-invalid' : ''), 'placeholder' => 'Tipo de Licencia']) }}
            {!! $errors->first('tipo_licencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('licencia') }}
            @if($card->licencia)
                <div>
                    <a href="{{ $card->licencia }}">Ver archivo actual</a>
                </div>
            @endif
            {{ Form::file('licencia', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('licencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('foto_piloto') }}
            {{ Form::file('foto_piloto', ['class' => 'form-control-file']) }}
            <p>IMAGEN</p>
            {!! $errors->first('foto_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group" >
            {{ Form::label('dpi_piloto')  }}
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
            {{ Form::label('antecedentes_penales') }}
            {{ Form::file('antecedentes_penales', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('antecedentes_penales', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('antecedentes_policiacos') }}
            {{ Form::file('antecedentes_policiacos', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('antecedentes_policiacos', '<div class="invalid-feedback">:message</div>') !!}
        </div>        

        <div class="form-group">
            {{ Form::label('renas') }}
            {{ Form::file('renas', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('renas', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('boleto_ornato') }}
            {{ Form::file('boleto_ornato', ['class' => 'form-control-file']) }}
            <p>PDF</p>
            {!! $errors->first('boleto_ornato', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Campo para seleccionar un vehículo existente -->
        <div class="form-group">
            {{ Form::label('numero_vehiculo_id') }}
            {{ Form::select('numero_vehiculo_id', $vehi, $card->numero_vehiculo_id, ['class' => 'form-control' . ($errors->has('numero_vehiculo_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar Vehículo']) }}
            {!! $errors->first('numero_vehiculo_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>


    </div>
</div>
