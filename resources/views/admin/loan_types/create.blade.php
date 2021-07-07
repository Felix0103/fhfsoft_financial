@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Registro de tipo de prestamo</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.loancategories.index') }}" class="btn btn-secondary btn-sm float-right">Lista de tipos de prestamos</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.loancategories.store', 'class' => 'card']) !!}

    <div class="card-body">

        @include('admin.loan_types.partials.form')
        {!! Form::submit('Guardar tipo de prestamo', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
