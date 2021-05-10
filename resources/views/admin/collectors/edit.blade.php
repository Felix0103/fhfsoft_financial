@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <h1>Registro de cobrador</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.collectors.index') }}" class="btn btn-secondary btn-sm float-right">Lista de cobradores</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::model($collector ,['route' => ['admin.collectors.update', $collector], 'method'=>'put'], [ 'class' => 'card'] ) !!}

    <div class="card-body">

        @include('admin.collectors.partials.form')
        @livewire('address-component', $collector->address?$collector->address->toArray():[] )
        @livewire('contact-component', $collector->contact?$collector->contact->toArray():[] )
        {!! Form::submit('Actualizar Cobrador', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
