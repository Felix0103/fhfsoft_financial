@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Editar Prestamo</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary btn-sm float-right">Lista de prestamos</a>
        </div>
    </div>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            @livewire('admin.loan-edit', ['loan'=>$loan])
        </div>
    </div>
@stop
