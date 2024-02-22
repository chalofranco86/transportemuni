@extends('adminlte::page')

@section('title', __('NUEVO Vehiculo'))

@section('content_header')
    <h1>{{ __('Crear') }} Vehiculo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Create') }} Vehi</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('vehis.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('vehi.form')

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            <a class="btn btn-danger" href="{{ route('vehis.index') }}">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
