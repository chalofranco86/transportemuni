@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>JEFATURA DE TRANSPORTE PÚBLICO</h1>
@stop

@section('content')
    <p>.</p>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (Auth::user()->can('view', App\Models\Bitacora::class))
        <p>User can view Bitacora</p>
    @else
        <p>ROL NO PERMITIDO A ESTA FUNCIONALIDAD</p>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
