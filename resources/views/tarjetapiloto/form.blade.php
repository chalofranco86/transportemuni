

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('nombre_piloto') }}
            {{ Form::text('nombre_piloto', $tarjetapiloto->nombre_piloto, ['class' => 'form-control' . ($errors->has('nombre_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Piloto']) }}
            {!! $errors->first('nombre_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dpi_piloto') }}
            {{ Form::text('dpi_piloto', $tarjetapiloto->dpi_piloto, ['class' => 'form-control' . ($errors->has('dpi_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Dpi Piloto']) }}
            {!! $errors->first('dpi_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo_licencia_piloto') }}
            {{ Form::text('tipo_licencia_piloto', $tarjetapiloto->tipo_licencia_piloto, ['class' => 'form-control' . ($errors->has('tipo_licencia_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Licencia Piloto']) }}
            {!! $errors->first('tipo_licencia_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fotografia_piloto') }}
            {{ Form::file('fotografia_piloto', $tarjetapiloto->fotografia_piloto, ['class' => 'form-control' . ($errors->has('fotografia_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Fotografia Piloto']) }}
            {!! $errors->first('fotografia_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_emision_piloto') }}
            {{ Form::date('fecha_emision_piloto', $tarjetapiloto->fecha_emision_piloto, ['class' => 'form-control' . ($errors->has('fecha_emision_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Emision Piloto']) }}
            {!! $errors->first('fecha_emision_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_vencimiento_piloto') }}
            {{ Form::date('fecha_vencimiento_piloto', $tarjetapiloto->fecha_vencimiento_piloto, ['class' => 'form-control' . ($errors->has('fecha_vencimiento_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Vencimiento Piloto']) }}
            {!! $errors->first('fecha_vencimiento_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion_piloto') }}
            {{ Form::text('direccion_piloto', $tarjetapiloto->direccion_piloto, ['class' => 'form-control' . ($errors->has('direccion_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Direccion Piloto']) }}
            {!! $errors->first('direccion_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono_piloto') }}
            {{ Form::text('telefono_piloto', $tarjetapiloto->telefono_piloto, ['class' => 'form-control' . ($errors->has('telefono_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Piloto']) }}
            {!! $errors->first('telefono_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('correo_piloto') }}
            {{ Form::text('correo_piloto', $tarjetapiloto->correo_piloto, ['class' => 'form-control' . ($errors->has('correo_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Correo Piloto']) }}
            {!! $errors->first('correo_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('antecedentes_penales_piloto') }}
            {{ Form::file('antecedentes_penales_piloto', $tarjetapiloto->antecedentes_penales_piloto, ['class' => 'form-control' . ($errors->has('antecedentes_penales_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Antecedentes Penales Piloto']) }}
            {!! $errors->first('antecedentes_penales_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('antecedentes_policiacos_piloto') }}
            {{ Form::file('antecedentes_policiacos_piloto', $tarjetapiloto->antecedentes_policiacos_piloto, ['class' => 'form-control' . ($errors->has('antecedentes_policiacos_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Antecedentes Policiacos Piloto']) }}
            {!! $errors->first('antecedentes_policiacos_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('foto_licencia_piloto') }}
            {{ Form::file('foto_licencia_piloto', $tarjetapiloto->foto_licencia_piloto, ['class' => 'form-control' . ($errors->has('foto_licencia_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Foto Licencia Piloto']) }}
            {!! $errors->first('foto_licencia_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('renas_piloto') }}
            {{ Form::file('renas_piloto', $tarjetapiloto->renas_piloto, ['class' => 'form-control' . ($errors->has('renas_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Renas Piloto']) }}
            {!! $errors->first('renas_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('boleto_ornato_piloto') }}
            {{ Form::file('boleto_ornato_piloto', $tarjetapiloto->boleto_ornato_piloto, ['class' => 'form-control' . ($errors->has('boleto_ornato_piloto') ? ' is-invalid' : ''), 'placeholder' => 'Boleto Ornato Piloto']) }}
            {!! $errors->first('boleto_ornato_piloto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#ruta-dropdown').on('click', function(){
                $.ajax({
                    url: 'rutas', 
                    method: 'GET',
                    success: function(data){
                        var options = '';
                        $.each(data, function(id, numero_ruta){
                            options += '<option value="'+id+'">'+numero_ruta+'</option>';
                        });
                        $('#numero_ruta_id').html(options);
                    }
                });
            });
        });
    </script>
@endsection

</div>