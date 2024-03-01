<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre_ruta') }}
            {{ Form::text('nombre_ruta', $ruta->nombre_ruta, ['class' => 'form-control' . ($errors->has('nombre_ruta') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Ruta']) }}
            {!! $errors->first('nombre_ruta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numero_ruta') }}
            {{ Form::text('numero_ruta', $ruta->numero_ruta, ['class' => 'form-control' . ($errors->has('numero_ruta') ? ' is-invalid' : ''), 'placeholder' => 'Numero Ruta']) }}
            {!! $errors->first('numero_ruta', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('GUARDAR') }}</button>
    </div>
</div>