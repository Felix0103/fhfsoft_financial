@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.partners.create')
        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.partners.create')}}">Nuevo socio</a>
    @endcan
    <h1>Lista de socios</h1>
@stop

@section('content')
    @livewire('admin.partner-index')
@stop


