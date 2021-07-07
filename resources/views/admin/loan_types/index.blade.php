@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.loancategories.create')
        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.loancategories.create')}}">Nuevo tipo de prestamo</a>
    @endcan
    <h1>Lista de tipo de prestamos</h1>
@stop

@section('content')
    @livewire('admin.loan-type-index')
@stop


