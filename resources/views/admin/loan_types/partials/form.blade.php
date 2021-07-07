<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('description', 'Nombre del tipo de prestamo') !!}
            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digita el nombre del tipo de prestamo']) !!}
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('loan_type_id', 'Categoria del prestamo') !!}
            {!! Form::select('loan_type_id', $loanTypes, null,  ['class' => 'form-control', 'placeholder' => 'Selecciona una categoria de prestamos']) !!}
            @error('loan_type_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('billing_cycle_id', 'Frecuencia de facturación') !!}
            {!! Form::select('billing_cycle_id', $billingCycles, null,  ['class' => 'form-control', 'placeholder' => 'Selecciona una frecuencia de facturación']) !!}
            @error('billing_cycle_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('period_rate', 'Taza por default') !!}
            {!! Form::number('period_rate', null, ['class'=>'form-control', 'placeholder'=> 'Digita la tasa por default']) !!}
        </div>
        @error('period_rate')
                <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('duration', 'Duración por default') !!}
            {!! Form::number('duration', null, ['class'=>'form-control', 'placeholder'=> 'Digita la duración por default']) !!}
        </div>
        @error('duration')
                <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
