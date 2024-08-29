@extends('adminlte::page')

@section('title', 'TARJETAS PILOTO')

@section('content_header')
    <h1>{{ __('TARJETA PILOTO') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="card-title">{{ __('INFORMACION TARJETA PILOTO') }}</span>
                        <a class="btn btn-primary" href="{{ route('cards.index') }}">{{ __('ATRAS') }}</a>
                    </div>
                </div>

                 <div class="card-body">
                @csrf
                @method('CREATE')
                @if (in_array(auth()->user()->role, ['superadmin', 'admin']) || (auth()->user()->role === 'operador' && $card->estado_card === 'ACTIVO'))
                    <a href="{{ route('cards.pdf', ['id' => $card->id]) }}" class="btn btn-primary" target="_blank">Generar Tarjeta Piloto</a>
                @endif

                <!-- Botón Solicitar -->
                @if($card->estado_card != 'SOLICITADA')
                    @if(in_array(auth()->user()->role, ['superadmin', 'admin', 'operador']))
                        <form action="{{ route('cards.solicitar', $card->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning">Solicitar</button>
                        </form>
                    @endif
                @else
                    <button type="button" class="btn btn-secondary" disabled>Solicitado</button>
                @endif
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Información General -->
                            <div class="form-group">
                                <strong>Nombre Piloto:</strong>
                                {{ $card->nombre_piloto }}
                            </div>
                            <div class="form-group">
                                <strong>Dirección Piloto:</strong>
                                {{ $card->direccion_piloto }}
                            </div>
                            <div class="form-group">
                                <strong>Correo Piloto:</strong>
                                {{ $card->correo_piloto }}
                            </div>
                            <div class="form-group">
                                <strong>Telefono Piloto:</strong>
                                {{ $card->telefono_piloto }}
                            </div>
                        </div>
                    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Tipo Licencia:</strong>
                                    {{ $card->tipo_licencia }}
                                </div>
                                <div class="form-group">
                                    <strong>Fecha Emisión:</strong>
                                    {{ $card->fecha_emision }}
                                </div>
                                <div class="form-group">
                                    <strong>Fecha Vencimiento:</strong>
                                    {{ $card->fecha_vencimiento }}
                                </div>
                                <div class="form-group">
                                    <strong>Numero Vehiculo Id:</strong>
                                    {{ $card->vehi->nombre_vehi }}
                                </div>
                                <div class="form-group">
                                    <strong>ESTADO:</strong>
                                    {{ $card->estado_card }}
                                </div>
                            </div>
                        </div>

                    <hr>

                        <!-- Archivos PDF -->
                        <style>
                            .pdf-container {
                                width: 100%;
                                text-align: center;
                            }

                            .pdf-title {
                                font-size: 20px;  /* Ajusta el tamaño de la letra según tus preferencias */
                                margin-bottom: 10px;
                            }

                            .pdf-content {
                                width: 100%;
                            }
                        </style>

                        <div class="form-group pdf-container">
                            <div class="pdf-title">
                                <strong>Licencia:</strong>
                            </div>
                            <div class="pdf-content">
                                @if (pathinfo($card->licencia, PATHINFO_EXTENSION) === 'pdf')
                                    <embed src="{{ asset('storage/' . $card->licencia) }}" type="application/pdf" width="50%" height="300px" />
                                @else
                                    <img src="{{ asset('storage/' . $card->licencia) }}" alt="Licencia" style="max-width: 100%;" />
                                @endif
                            </div>
                        </div>

                        <div class="form-group pdf-container">
                            <div class="pdf-title">
                                <strong>Antecedentes Penales:</strong>
                            </div>
                            <div class="pdf-content">
                                @if (pathinfo($card->antecedentes_penales, PATHINFO_EXTENSION) === 'pdf')
                                    <embed src="{{ asset('storage/' . $card->antecedentes_penales) }}" type="application/pdf" width="50%" height="300px" />
                                @else
                                    <img src="{{ asset('storage/' . $card->antecedentes_penales) }}" alt="Antecedentes Penales" style="max-width: 100%;" />
                                @endif
                            </div>
                        </div>

                        <div class="form-group pdf-container">
                            <div class="pdf-title">
                                <strong>Antecedentes Policiacos:</strong>
                            </div>
                            <div class="pdf-content">
                                @if (pathinfo($card->antecedentes_policiacos, PATHINFO_EXTENSION) === 'pdf')
                                    <embed src="{{ asset('storage/' . $card->antecedentes_policiacos) }}" type="application/pdf" width="50%" height="200px" />
                                @else
                                    <img src="{{ asset('storage/' . $card->antecedentes_policiacos) }}" alt="Antecedentes Policiacos" style="max-width: 100%;" />
                                @endif
                            </div>
                        </div>

                        <div class="form-group pdf-container">
                            <div class="pdf-title">
                                <strong>Renas:</strong>
                            </div>
                            <div class="pdf-content">
                                @if (pathinfo($card->renas, PATHINFO_EXTENSION) === 'pdf')
                                    <embed src="{{ asset('storage/' . $card->renas) }}" type="application/pdf" width="50%" height="300px" />
                                @else
                                    <img src="{{ asset('storage/' . $card->renas) }}" alt="Renas" style="max-width: 100%;" />
                                @endif
                            </div>
                        </div>

                        <hr>

                        <!-- Archivo Adjunto con Enlace -->
                        <div class="form-group pdf-container">
                            <div class="pdf-title">
                                <strong>Boleto Ornato:</strong>
                            </div>
                            <div class="pdf-content">
                                @if ($card->boleto_ornato)
                                    <object data="{{ asset('storage/' . $card->boleto_ornato) }}" type="application/pdf" width="50%" height="300px">
                                        <p>Este navegador no puede mostrar el archivo PDF. Puedes <a href="{{ asset('storage/' . $card->boleto_ornato) }}" target="_blank">descargarlo</a> en su lugar.</p>
                                    </object>
                                @else
                                    No hay archivo adjunto
                                @endif
                            </div>
                        </div>
                    
                    <hr>

                    <!-- Fotos -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Foto Piloto:</strong>
                                @if ($card->foto_piloto)
                                    <!-- Reemplaza 'imagen' por el campo que estás usando en tu modelo para la foto del piloto -->
                                    <img src="{{ asset('storage/' . $card->foto_piloto) }}" alt="Foto Piloto" style="max-width: 50%;" />
                                @else
                                    No hay foto del piloto
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>DPI Piloto:</strong>
                                @if ($card->dpi_piloto)
                                    <!-- Reemplaza 'imagen' por el campo que estás usando en tu modelo para el DPI del piloto -->
                                    <img src="{{ asset('storage/' . $card->dpi_piloto) }}" alt="DPI Piloto" style="max-width: 50%;" />
                                @else
                                    No hay DPI del piloto
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop