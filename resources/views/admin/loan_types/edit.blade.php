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
            <h1>Actualizacion de tipo de prestamo</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.loancategories.index') }}" class="btn btn-secondary btn-sm float-right">Lista de tipo de prestamos</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::model($loancategory ,['route' => ['admin.loancategories.update', $loancategory], 'method'=>'put'], [ 'class' => 'card'] ) !!}

    <div class="card-body">

        @include('admin.loan_types.partials.form')


        {!! Form::submit('Actualizar Tipo de Prestamo', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}





@stop

