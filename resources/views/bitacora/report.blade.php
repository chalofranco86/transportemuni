@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>BITACORA</h1>

    <div class="float-right">
        <a href="{{ route('bitacora.pdf') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
            {{ __('GENERAR PDF BITACORA') }}
        </a>

    </div>
@stop

@section('content')
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bitacora as $registro)
            <tr>
                <td>{{ $registro->id }}</td>
                <td>{{ $registro->user_id }}</td>
                <td>{{ $registro->descripcion }}</td>
                <td>{{ $registro->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
@stop
