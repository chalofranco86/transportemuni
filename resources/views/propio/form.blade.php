<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre_propietario') }}
            {{ Form::text('nombre_propietario', $propio->nombre_propietario, ['class' => 'form-control' . ($errors->has('nombre_propietario') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Propietario']) }}
            {!! $errors->first('nombre_propietario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dpi_propietario') }}
            {{ Form::file('dpi_propietario', ['class' => 'form-control-file' . ($errors->has('dpi_propietario') ? ' is-invalid' : '')]) }}
            {!! $errors->first('dpi_propietario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nit_propietario') }}
            {{ Form::text('nit_propietario', $propio->nit_propietario, ['class' => 'form-control' . ($errors->has('nit_propietario') ? ' is-invalid' : ''), 'placeholder' => 'Nit Propietario']) }}
            {!! $errors->first('nit_propietario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono_propietario') }}
            {{ Form::text('telefono_propietario', $propio->telefono_propietario, ['class' => 'form-control' . ($errors->has('telefono_propietario') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Propietario']) }}
            {!! $errors->first('telefono_propietario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('correo_propietario') }}
            {{ Form::text('correo_propietario', $propio->correo_propietario, ['class' => 'form-control' . ($errors->has('correo_propietario') ? ' is-invalid' : ''), 'placeholder' => 'Correo Propietario']) }}
            {!! $errors->first('correo_propietario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion_fiscal') }}
            {{ Form::text('direccion_fiscal', $propio->direccion_fiscal, ['class' => 'form-control' . ($errors->has('direccion_fiscal') ? ' is-invalid' : ''), 'placeholder' => 'Direccion Fiscal']) }}
            {!! $errors->first('direccion_fiscal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numero_vehiculos_asociados') }}
            {{ Form::text('numero_vehiculos_asociados', is_array($propio->vehiculos) ? count($propio->vehiculos) : 0, ['class' => 'form-control' . ($errors->has('numero_vehiculos_asociados') ? ' is-invalid' : ''), 'placeholder' => 'Numero Vehiculos Asociados', 'readonly' => 'readonly']) }}
            {!! $errors->first('numero_vehiculos_asociados', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('nombre_empresa') }}
            {{ Form::text('nombre_empresa', $propio->nombre_empresa, ['class' => 'form-control' . ($errors->has('nombre_empresa') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Empresa']) }}
            {!! $errors->first('nombre_empresa', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nit_empresa') }}
            {{ Form::text('nit_empresa', $propio->nit_empresa, ['class' => 'form-control' . ($errors->has('nit_empresa') ? ' is-invalid' : ''), 'placeholder' => 'NIT Empresa']) }}
            {!! $errors->first('nit_empresa', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="form-group">
            {{ Form::label('numero_vehiculo_id', 'Seleccionar Vehículos') }}
            {{ Form::select('numero_vehiculo_id[]', $vehi->pluck('nombre_vehi', 'id'), $propio->vehiculos_asociados, ['class' => 'form-control vehiculo-select', 'multiple' => 'multiple']) }}
            {!! $errors->first('numero_vehiculo_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>                                                                                                      

        <ul id="selectedVehiclesList">
            @if(isset($vehiculosAsociados))
                @foreach($vehi as $vehiculo)
                    @if(in_array($vehiculo->id, old('vehi_id', $vehiculosAsociados)))
                        <li>{{ $vehiculo->nombre_vehi }}</li>
                    @endif
                @endforeach
            @endif
        </ul>
    

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
        // Inicializar la variable vehiculosAsociados como un array vacío
        var vehiculosAsociados = {!! json_encode(old('vehi_id', $vehiculosAsociados)) !!};

        // Escuchar cambios en la selección de vehículos y actualizar la lista dinámicamente
        $("#vehi_id").change(function () {
            updateSelectedVehiclesList();
        });

        // Función para actualizar la lista de vehículos seleccionados
        function updateSelectedVehiclesList() {
            var selectedVehiclesList = $("#selectedVehiclesList");
            selectedVehiclesList.empty();

            // Obtener los vehículos seleccionados
            $(".vehiculo-select").each(function () {
                var selectedVehicles = $(this).val();

                // Mostrar los vehículos seleccionados en la lista
                selectedVehicles.forEach(function (vehicleId) {
                    var vehicleName = $(this).find("option[value='" + vehicleId + "']").text();
                    selectedVehiclesList.append('<li>' + vehicleName + '</li>');
                }.bind(this)); // Agrega .bind(this) para asegurar que $(this) se refiere al elemento correcto
            });
        }

        // Llamar a la función para actualizar la lista al cargar la página
        updateSelectedVehiclesList();
        });
    </script>

    <script>
$(document).ready(function () {
        // Inicializar la variable vehiculosAsociados como un array vacío
        var vehiculosAsociados = {!! json_encode(old('vehi_id', $vehiculosAsociados)) !!};

        // Escuchar cambios en la selección de vehículos y actualizar la lista dinámicamente
        $(".vehiculo-select").change(function () {
            updateSelectedVehiclesList();
        });

        // Función para actualizar la lista de vehículos seleccionados
        function updateSelectedVehiclesList() {
            var selectedVehiclesList = $("#selectedVehiclesList");
            selectedVehiclesList.empty();

            // Obtener los vehículos seleccionados
            $(".vehiculo-select").each(function () {
                var selectedVehicles = $(this).val();

                // Mostrar los vehículos seleccionados en la lista
                selectedVehicles.forEach(function (vehicleId) {
                    var vehicleName = $(this).find("option[value='" + vehicleId + "']").text();
                    selectedVehiclesList.append('<li>' + vehicleName + '</li>');
                });
            });
        }

        // Llamar a la función para actualizar la lista al cargar la página
        updateSelectedVehiclesList();

        // Manejar el evento de clic en el botón "Agregar otro vehículo"
        $("#agregarVehiculo").click(function () {
    console.log("Botón clickeado");

    // Clonar el select actual
    var clonedSelect = $(".vehiculo-select:last").clone();

    // Limpiar la selección en el nuevo clon
    clonedSelect.val(null);

    // Incrementar el id y name del nuevo clon para evitar conflictos
    var currentId = clonedSelect.attr('id');
    var currentName = clonedSelect.attr('name');

    // Obtener el índice actual
    var currentIndex = parseInt(currentId.replace('numero_vehiculo_id_', ''));

    // Incrementar el índice para el nuevo clon
    var newIndex = currentIndex + 1;

    // Modificar id y name del nuevo clon
    clonedSelect.attr('id', 'numero_vehiculo_id_' + newIndex);
    clonedSelect.attr('name', 'numero_vehiculo_id_' + newIndex);

    // Agregar el clon al final del contenedor
    $(".vehiculo-select:last").after(clonedSelect);
        });
    });
    </script>

    </div>

</div>