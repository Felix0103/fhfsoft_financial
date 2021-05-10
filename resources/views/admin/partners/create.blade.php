@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Registro de socios</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary btn-sm float-right">Lista de
                socios</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.partners.store', 'class' => 'card']) !!}

    <div class="card-body">

        @include('admin.partners.partials.form')
        @livewire('address-component')
        @livewire('contact-component')
        {!! Form::submit('Guardar Socio', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
