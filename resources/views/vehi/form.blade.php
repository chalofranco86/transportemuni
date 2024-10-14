<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre_vehi') }}
            {{ Form::text('nombre_vehi', $vehi->nombre_vehi, ['class' => 'form-control' . ($errors->has('nombre_vehi') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Vehiculo']) }}
            {!! $errors->first('nombre_vehi', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('placa_vehi') }}
            {{ Form::text('placa_vehi', $vehi->placa_vehi, ['class' => 'form-control' . ($errors->has('placa_vehi') ? ' is-invalid' : ''), 'placeholder' => 'Placa Vehiculo']) }}
            {!! $errors->first('placa_vehi', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tarjeta_circulacion') }}
            {{ Form::file('tarjeta_circulacion', ['class' => 'form-control-file' . ($errors->has('tarjeta_circulacion') ? ' is-invalid' : '')]) }}
            <p>PDF</p>
            {!! $errors->first('tarjeta_circulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('titulo_propiedad') }}
            {{ Form::file('titulo_propiedad', ['class' => 'form-control-file' . ($errors->has('titulo_propiedad') ? ' is-invalid' : '')]) }}
            <p>PDF</p>
            {!! $errors->first('titulo_propiedad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo_vehi', 'Tipo Vehiculo') }}
            {{ Form::select('tipo_vehi', $tiposVehi, null, [
                'class' => 'form-control' . ($errors->has('tipo_vehi') ? ' is-invalid' : ''),
                'placeholder' => 'Seleccionar Tipo Vehiculo'
            ]) }}
            {!! $errors->first('tipo_vehi', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numero_ruta_id', 'Número de Ruta') }}
            {{ Form::select('numero_ruta_id', $rutas, $vehi->numero_ruta_id, ['class' => 'form-control' . ($errors->has('numero_ruta_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona una ruta']) }}
            {!! $errors->first('numero_ruta_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>

</div>