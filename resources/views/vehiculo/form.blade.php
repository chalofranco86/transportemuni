<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre_vehiculo') }}
            {{ Form::text('nombre_vehiculo', $vehiculo->nombre_vehiculo, ['class' => 'form-control' . ($errors->has('nombre_vehiculo') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Vehiculo']) }}
            {!! $errors->first('nombre_vehiculo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('placa_vehiculo') }}
            {{ Form::text('placa_vehiculo', $vehiculo->placa_vehiculo, ['class' => 'form-control' . ($errors->has('placa_vehiculo') ? ' is-invalid' : ''), 'placeholder' => 'Placa Vehiculo']) }}
            {!! $errors->first('placa_vehiculo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tarjeta_circulacion') }}
            {{ Form::file('tarjeta_circulacion', ['class' => 'form-control-file' . ($errors->has('tarjeta_circulacion') ? ' is-invalid' : '')]) }}
            {!! $errors->first('tarjeta_circulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('titulo_propiedad') }}
            {{ Form::file('titulo_propiedad', ['class' => 'form-control-file' . ($errors->has('titulo_propiedad') ? ' is-invalid' : '')]) }}
            {!! $errors->first('titulo_propiedad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo_vehiculo') }}
            {{ Form::text('tipo_vehiculo', $vehiculo->tipo_vehiculo, ['class' => 'form-control' . ($errors->has('tipo_vehiculo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Vehiculo']) }}
            {!! $errors->first('tipo_vehiculo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numero_ruta_id') }}
            {{ Form::select('numero_ruta_id', $rutas, $vehiculo->numero_ruta_id, ['class' => 'form-control' . ($errors->has('numero_ruta_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una ruta']) }}
            {!! $errors->first('numero_ruta_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('nombre_piloto_id') }}
            {{ Form::select('nombre_piloto_id', $pilotos, $vehiculo->nombre_piloto_id, ['class' => 'form-control' . ($errors->has('nombre_piloto_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un piloto']) }}
            {!! $errors->first('nombre_piloto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
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