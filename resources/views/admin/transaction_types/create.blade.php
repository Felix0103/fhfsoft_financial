@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Registro de Transacciones</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.transactiontypes.index') }}" class="btn btn-secondary btn-sm float-right">Lista de transacciones</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.transactiontypes.store', 'class' => 'card']) !!}

    <div class="card-body">

        @include('admin.transaction_types.partials.form')

        {!! Form::submit('Guardar Transacion', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
