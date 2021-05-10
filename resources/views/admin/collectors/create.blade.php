@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Registro de corbrador</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.collectors.index') }}" class="btn btn-secondary btn-sm float-right">Lista de
                cobradores</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.collectors.store', 'class' => 'card']) !!}

    <div class="card-body">

        @include('admin.collectors.partials.form')
        @livewire('address-component')
        @livewire('contact-component')
        {!! Form::submit('Guardar Cobrador', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
