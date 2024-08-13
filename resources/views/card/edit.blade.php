@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tarjeta Piloto</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Card</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cards.update', $card->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('card.form')

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                                <a class="btn btn-danger" href="{{ route('cards.index') }}">{{ __('Cancelar') }}</a>
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
