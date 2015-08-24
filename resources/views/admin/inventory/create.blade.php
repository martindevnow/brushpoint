@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.partials._errors')
    </div>
    <div class="row">
        <div class="col-s-12">
            {!! Form::open(['method' => 'post', 'url' => ['admins/inventory'], 'id'=>'inventory_form']) !!}
            <div class="modal-body">
              <div class="form-group">
                  {!! Form::label('item_id', 'Item / SKU:') !!}
                  {!! Form::select('item_id', $itemListByIdName, null, ['class' => 'form-control']) !!}
              </div>
              <div class="form-group">
                  {!! Form::label('lot_code', 'Lot Code:') !!}
                  {!! Form::text('lot_code', null, ['class' => 'form-control']) !!}
              </div>
              <div class="form-group">
                  {!! Form::label('expiry_date', 'Expiry Date:') !!}
                  {!! Form::text('expiry_date', null, ['class' => 'form-control', 'id' => 'datepicker']) !!}
              </div>
              <div class="form-group">
                  {!! Form::label('quantity', 'Quantity:') !!}
                  {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
              </div>
              {{--<div class="form-group">--}}
                  {{--{!! Form::label('description', 'Description:') !!}--}}
                  {{--{!! Form::text('description', 'available', ['class' => 'form-control']) !!}--}}
              {{--</div>--}}
              <div class="form-group">
                  {!! Form::label('status', 'Status:') !!}
                  {!! Form::text('status', 'available', ['class' => 'form-control']) !!}
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>
<div class="flash">
    Updated...
</div>

@stop
