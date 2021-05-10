@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop


