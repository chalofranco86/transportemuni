@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Vehiculo</h1>
@stop

@section('content')
@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Vehi</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vehis.update', $vehi->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('vehi.form')

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

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
