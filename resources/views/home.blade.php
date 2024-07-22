@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>JEFATURA DE TRANSPORTE PÚBLICO</h1>
@stop

@section('content')
    <div style="display: flex; align-items: center;">
        <img src="{{ asset('vendor/adminlte/dist/img/cochegif.gif') }}" alt="Coche GIF" style="width: 1000px; height: auto; margin-right: 20px;">
        <img src="{{ asset('vendor/adminlte/dist/img/transportelogo.jpeg') }}" alt="Transporte Logo" style="width: 1000px; height: auto;">
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
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
