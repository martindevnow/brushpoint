 <div class="form-group">
     {!! Form::label('street_1', 'Street:') !!}
     {!! Form::text('street_1', null, ['class' => 'form-control']) !!}
 </div>
 <div class="form-group">
     {!! Form::text('street_2', null, ['class' => 'form-control']) !!}
 </div>

  <div class="form-group">
      {!! Form::label('city', 'City:') !!}
      {!! Form::text('city', null, ['class' => 'form-control']) !!}
  </div>
 <div class="form-group">
     {!! Form::label('province', 'State/Province:') !!}
     {!! Form::text('province', null, ['class' => 'form-control']) !!}
 </div>
 <div class="form-group">
     {!! Form::label('postal_code', 'Postal/Zip Code:') !!}
     {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
 </div>
 <div class="form-group">
     {!! Form::label('country', 'Country:') !!}
     {!! Form::select('country', ['Canada' => 'Canada', 'United States' => 'United State'], null ,['class' => 'form-control']) !!}
 </div>
 <div class="form-group">
     {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
 </div>
