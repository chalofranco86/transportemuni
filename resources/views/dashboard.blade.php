@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="responsive-container">
        <img src="{{ asset('vendor/adminlte/dist/img/transportelogo.jpeg') }}" alt="Logo" class="responsive-image">
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .responsive-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .responsive-image {
            width: 100%;
            max-width: 500px;
            height: auto;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@if (Auth::user()->can('view', App\Models\Bitacora::class))
    <p>User can view Bitacora</p>
@else
    <p>User cannot view Bitacora</p>
@endif