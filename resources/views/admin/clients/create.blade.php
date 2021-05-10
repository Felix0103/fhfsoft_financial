@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Registro de cliente</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary btn-sm float-right">Lista de
                clientes</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.clients.store', 'class' => 'card']) !!}

    <div class="card-body">

        @include('admin.clients.partials.form')
        @livewire('address-component')
        @livewire('contact-component')
        {!! Form::submit('Guardar Cliente', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
