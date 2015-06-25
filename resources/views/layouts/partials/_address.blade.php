<div class="form-group">
    {!! Form::label('street_1', 'Street:') !!}
    {!! Form::text('street_1', null, ['class' => 'form-control', 'required', 'title' => 'What is your street address?']) !!}
</div>
<div class="form-group">
    {!! Form::text('street_2', null, ['class' => 'form-control']) !!}

</div>
<div class="form-group">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control', 'required', 'title' => 'What city do you live in?']) !!}
</div>
<div class="form-group">
    {!! Form::label('province', 'State/Province:') !!}
    {!! Form::text('province', null, ['class' => 'form-control', 'required', 'title' => 'What province or state do you live in?']) !!}
</div>
<div class="form-group">
    {!! Form::label('postal_code', 'Postal/Zip Code:') !!}
    {!! Form::text('postal_code', null, ['class' => 'form-control', 'required', 'title' => 'What is your postal or zip code?']) !!}
</div>
<div class="form-group">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::select('country', ['Canada' => 'Canada', 'United States' => 'United State'], null ,['class' => 'form-control', 'required', 'title' => 'What country do you live in?']) !!}
</div>
