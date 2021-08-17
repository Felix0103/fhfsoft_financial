<div class="row">

    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('code', 'Codigo de cuenta') !!}
            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Digita el codigo']) !!}
            @error('code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-9">
        <div class="form-group">
            {!! Form::label('description', 'Nombre de cuenta') !!}
            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digita el nombre de la cuenta']) !!}
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
