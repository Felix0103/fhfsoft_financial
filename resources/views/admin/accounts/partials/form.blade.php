<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('description', 'Nombre de cuenta') !!}
            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digita el nombre de la cuenta']) !!}
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
