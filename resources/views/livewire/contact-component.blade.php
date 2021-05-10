<div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('phone', 'Telefono') !!}
                {!! Form::text('phone', $phone??null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('cell_phone', 'Celular') !!}
                {!! Form::text('cell_phone', $cell_phone??null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $email??null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
