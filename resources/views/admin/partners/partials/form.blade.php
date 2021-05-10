<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('first_name', 'Nombre') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Digita el nombre del socio']) !!}
            @error('first_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('last_name', 'Apellido') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Digita el apellido del socio']) !!}
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
            {!! Form::text('identification', null, ['class' => 'form-control', 'placeholder' => 'Digita la identificación del socio']) !!}
            @error('identification')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('initial_investment', 'Inversión inicial') !!}
            {!! Form::number('initial_investment', null, ['class' => 'form-control', 'placeholder' => 'Digita la inversion inicial del socio']) !!}
            @error('initial_investment')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('percentage_earn', 'Porcentage de ganancias') !!}
            {!! Form::number('percentage_earn', null, ['class' => 'form-control', 'placeholder' => 'Digita el porcentage de ganancias']) !!}
            @error('percentage_earn')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
