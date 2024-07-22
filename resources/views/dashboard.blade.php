@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')

    <img src="{{ asset('vendor/adminlte/dist/img/transportelogo.jpeg') }}" alt="Logo">
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@if (Auth::user()->can('view', App\Models\Bitacora::class))
    <p>User can view Bitacora</p>
@else
    <p>User cannot view Bitacora</p>
@endif