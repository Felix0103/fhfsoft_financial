@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.transactiontypes.create')
        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.transactiontypes.create')}}">Nuevo tipo de transaccion</a>
    @endcan
    <h1>Lista de tipos de transacciones</h1>
@stop

@section('content')
    @livewire('admin.transaction-type-index')
@stop


