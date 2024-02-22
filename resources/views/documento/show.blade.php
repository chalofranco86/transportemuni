@extends('layouts.app')

@section('template_title')
    {{ $documento->name ?? "{{ __('Show') Documento" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Documento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('documentos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Antecedentes AAA:</strong>
                            {{ $documento->antecedentes_policiacos }}
                        </div>
                        <div class="form-group">
                            <strong>Antecedentes Penales:</strong>
                            {{ $documento->antecedentes_penales }}
                        </div>
                        <div class="form-group">
                            <strong>Renas:</strong>
                            {{ $documento->renas }}
                        </div>
                        <div class="form-group">
                            <strong>Licentia Tipo:</strong>
                            {{ $documento->licentia_tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Dpi:</strong>
                            {{ $documento->dpi }}
                        </div>
                        <div class="form-group">
                            <strong>Boleto Ornato:</strong>
                            {{ $documento->boleto_ornato }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion Fiscal:</strong>
                            {{ $documento->direccion_fiscal }}
                        </div>
                        <div class="form-group">
                            <strong>Correo Documento:</strong>
                            {{ $documento->correo_documento }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono Documento:</strong>
                            {{ $documento->telefono_documento }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
