@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Inventory</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>

    <div class="row">
        @if (isset($item))
            <div class="col-md-4">
                @include('admin.layouts.panels._item', ['item' => $item])
            </div>
        @endif

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">New Inventory</div>
                <div class="panel-body">
                    <div class="row">
                        @include('layouts.partials._errors')
                    </div>
                    {!! Form::open(['method' => 'post', 'url' => ['admins/inventory'], 'id'=>'inventory_form']) !!}
                    <div class="modal-body">
                      <div class="form-group">
                          {!! Form::label('item_id', 'Item / SKU:') !!}
                          {!! Form::select('item_id', $itemListByIdName, ( isset($item) ? $item->id : null ) , ['class' => 'form-control']) !!}
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
        <!-- /.col-md-9 -->
    </div>
</div>
<div class="flash">
    Updated...
</div>

@stop
