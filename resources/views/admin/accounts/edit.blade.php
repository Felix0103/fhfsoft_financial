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
            <h1>Actualizacion de cuenta</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-sm float-right">Lista de cuentas</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::model($account ,['route' => ['admin.accounts.update', $account], 'method'=>'put'], [ 'class' => 'card'] ) !!}

    <div class="card-body">

        @include('admin.accounts.partials.form')


        {!! Form::submit('Actualizar Cuenta', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    @error('description2')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    @include('admin.accounts.partials.sub_accounts')

    <div class="modal fade" id="sub-account-create">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Creacion de sub cuenta</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['route'=>'admin.subaccounts.store', 'method'=>'post']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::text('code2', null, ['class'=>'form-control','placeholder' => "Codigo" ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                {!! Form::hidden('account_id', $account->id) !!}
                                {!! Form::text('description2', null, ['class'=>'form-control','placeholder' => "Digite el nombre de la sub cuenta de $account->description" ]) !!}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                {!! Form::submit( 'Crear sub cuenta', ['class'=> "btn btn-primary"] ) !!}
                </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

