@extends('adminlte::page')

@section('title', 'Aplicación de pagos')

@section('content_header')
     <h1 class="text-center">Aplicación de pagos</h1>
@stop

@section('content')
    @livewire('admin.create-payment')
@stop
