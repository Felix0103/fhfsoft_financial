@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.loans.create')
        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.loans.create')}}">Nuevo prestamo</a>
    @endcan
    <h1>Lista de prestamos</h1>
@stop

@section('content')
    @livewire('admin.loan-index')
@stop


