@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.collectors.create')
        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.collectors.create')}}">Nuevo cobrador</a>
    @endcan
    <h1>Lista de cobradores</h1>
@stop

@section('content')
    @livewire('admin.collector-index')
@stop


