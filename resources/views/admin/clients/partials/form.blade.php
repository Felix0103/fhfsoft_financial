<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('first_name', 'Nombre') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Digita el nombre del cliente']) !!}
            @error('first_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('last_name', 'Apellido') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Digita el apellido del cliente']) !!}
            @error('last_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('identification_type_id', 'Tipo de identificación') !!}
            {!! Form::select('identification_type_id', $identificationTypes, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un tipo de id']) !!}
            @error('identification_type_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('identification', 'Identificación') !!}
            {!! Form::text('identification', null, ['class' => 'form-control', 'placeholder' => 'Digita la identificación del cliente']) !!}
            @error('identification')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('credit_limit', 'Limite de credito') !!}
            {!! Form::number('credit_limit', null, ['class' => 'form-control', 'placeholder' => 'Digita el limite de credito del cliente']) !!}
            @error('credit_limit')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('partner_id', 'Socio') !!}
            {!! Form::select('partner_id', $partners ,null, ['class' => 'form-control', 'placeholder' => 'Selecciona el socio del cliente']) !!}
        </div>
        @error('partner_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
