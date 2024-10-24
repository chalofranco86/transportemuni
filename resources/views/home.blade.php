@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>JEFATURA DE TRANSPORTE PÚBLICO</h1>
@stop

@section('content')
    <div class="responsive-container">
        <img src="{{ asset('vendor/adminlte/dist/img/cochegif.gif') }}" alt="Coche GIF" class="responsive-image">
        <img src="{{ asset('vendor/adminlte/dist/img/transportelogo.jpeg') }}" alt="Transporte Logo" class="responsive-image">
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (Auth::user()->can('view', App\Models\Bitacora::class))
        <p>User can view Bitacora</p>
    @else

    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .responsive-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .responsive-image {
            width: 100%;
            max-width: 500px;
            height: auto;
            margin: 10px;
        }
        @media (min-width: 768px) {
            .responsive-image {
                max-width: 45%;
            }
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop