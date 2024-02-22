@extends('adminlte::page')

@section('title', __('NUEVO Vehiculo'))

@section('content_header')
    <h1>{{ __('Create') }} Vehiculo</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Propio</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('propio.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('propio.form')
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{ __('CREAR') }}</button>
                                <a class="btn btn-danger" href="{{ route('vehis.index') }}">{{ __('Cancelar') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
