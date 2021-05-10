@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.clients.create')
        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.clients.create')}}">Nuevo cliente</a>
    @endcan
    <h1>Lista de clientes</h1>
@stop

@section('content')
    @livewire('admin.client-index')
@stop


