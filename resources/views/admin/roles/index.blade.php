@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    @can('admin.roles.create')

    <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.roles.create')}}">Nuevo rol</a>
    @endcan
    <h1>Lista de roles</h1>
@stop

@section('content')
    @livewire('admin.roles-index')
@stop

