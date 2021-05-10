<div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('description', 'Dirección') !!}
                {!! Form::text('description', ($description??null), ['class'=>'form-control', 'placeholder'=>'Digita la direccion']) !!}
            </div>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('country_id', 'Pais') !!}
                {!! Form::select('country_id', $countries, ($country_id??null), ['class'=>'form-control', 'placeholder'=> 'Selecciona el pais']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('state_id', 'Provincia') !!}
                {!! Form::select('state_id', $states, ($state_id??null), ['class'=>'form-control', 'placeholder'=> 'Selecciona una provincia']) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('city_id', 'Ciudad') !!}
                {!! Form::select('city_id', $cities, ($city_id??null), ['class'=>'form-control', 'placeholder'=> 'Seleccion una ciudad']) !!}
            </div>
        </div>
    </div>
</div>
