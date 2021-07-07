@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Registro de cuenta</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-sm float-right">Lista de cuentas</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.accounts.store', 'class' => 'card']) !!}

    <div class="card-body">

        @include('admin.accounts.partials.form')
        {!! Form::submit('Guardar Cuenta', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
