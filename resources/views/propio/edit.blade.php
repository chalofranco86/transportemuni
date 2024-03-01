@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>PROPIETARIO EDIT</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Propio</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('propios.update', $propio->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('propio.form')

                            <!-- Botones GUARDAR y CANCELAR -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">GUARDAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop