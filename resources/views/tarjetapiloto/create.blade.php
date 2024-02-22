@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pilotos</h1>
@stop

@section('content')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Tarjetapiloto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tarjetapilotos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tarjetapiloto.form')

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
