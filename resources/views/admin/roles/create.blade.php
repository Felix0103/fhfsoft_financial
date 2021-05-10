@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Creacion de role</h1>
@stop

@section('content')
    {!! Form::open(['route'=>'admin.roles.store']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Nombre:') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <h2 class="h3">Lista de permisos</h2>
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-sm-4">
                    <label>
                        {!! Form::checkbox('permissions[]', $permission->id, null, ['class'=>'mr-1']) !!}
                        {{$permission->description}}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="row">
            @error('permissions')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>


        <br>
        {!! Form::submit('Crear Rol', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop

