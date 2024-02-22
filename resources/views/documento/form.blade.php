<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('antecedentes_policiacos', 'Antecedentes Policiacos') }}
            {{ Form::file('antecedentes_policiacos', $documento->antecedentes_policiacos, ['class' => 'form-control' . ($errors->has('antecedentes_policiacos') ? ' is-invalid' : ''), 'placeholder' => 'Antecedentes Poli']) }}
            {!! $errors->first('antecedentes_policiacos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('antecedentes_penales', 'Antecedentes Penales') }}
            {{ Form::file('antecedentes_penales', $documento->antecedentes_penales, ['class' => 'form-control' . ($errors->has('antecedentes_penales') ? ' is-invalid' : ''), 'placeholder' => 'Antecedentes Penales']) }}
            {!! $errors->first('antecedentes_penales', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('renas') }}
            {{ Form::text('renas', $documento->renas, ['class' => 'form-control' . ($errors->has('renas') ? ' is-invalid' : ''), 'placeholder' => 'Renas']) }}
            {!! $errors->first('renas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('licentia_tipo') }}
            {{ Form::text('licentia_tipo', $documento->licentia_tipo, ['class' => 'form-control' . ($errors->has('licentia_tipo') ? ' is-invalid' : ''), 'placeholder' => 'Licentia Tipo']) }}
            {!! $errors->first('licentia_tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dpi') }}
            {{ Form::text('dpi', $documento->dpi, ['class' => 'form-control' . ($errors->has('dpi') ? ' is-invalid' : ''), 'placeholder' => 'Dpi']) }}
            {!! $errors->first('dpi', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('boleto_ornato') }}
            {{ Form::text('boleto_ornato', $documento->boleto_ornato, ['class' => 'form-control' . ($errors->has('boleto_ornato') ? ' is-invalid' : ''), 'placeholder' => 'Boleto Ornato']) }}
            {!! $errors->first('boleto_ornato', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion_fiscal') }}
            {{ Form::text('direccion_fiscal', $documento->direccion_fiscal, ['class' => 'form-control' . ($errors->has('direccion_fiscal') ? ' is-invalid' : ''), 'placeholder' => 'Direccion Fiscal']) }}
            {!! $errors->first('direccion_fiscal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('correo_documento') }}
            {{ Form::text('correo_documento', $documento->correo_documento, ['class' => 'form-control' . ($errors->has('correo_documento') ? ' is-invalid' : ''), 'placeholder' => 'Correo Documento']) }}
            {!! $errors->first('correo_documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono_documento') }}
            {{ Form::text('telefono_documento', $documento->telefono_documento, ['class' => 'form-control' . ($errors->has('telefono_documento') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Documento']) }}
            {!! $errors->first('telefono_documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>