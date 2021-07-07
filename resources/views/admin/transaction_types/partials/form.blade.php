<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('description', 'Nombre del tipo de transaccion') !!}
            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digita el nombre del tipo de transaccion']) !!}
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>

<div class="row">

        <div class="col-sm-3">
            <div class="form-group">
            <label for="type">
                {!! Form::radio('type', 1, null, ['class' => 'form-control']) !!}
                Credito
            </label>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">

            <label for="type">
                {!! Form::radio('type', 2, null, ['class' => 'form-control']) !!}
                Debito
            </label>
            </div>
        </div>

</div>
<div class="row">
    @error('type')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
