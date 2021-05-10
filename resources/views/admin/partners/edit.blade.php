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
            <h1>Registro de socio</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary btn-sm float-right">Lista de socios</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::model($partner ,['route' => ['admin.partners.update', $partner], 'method'=>'put'], [ 'class' => 'card'] ) !!}

    <div class="card-body">

        @include('admin.partners.partials.form')
        @livewire('address-component', $partner->address?$partner->address->toArray():[] )
        @livewire('contact-component', $partner->contact?$partner->contact->toArray():[] )
        {!! Form::submit('Actualizar Socio', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
