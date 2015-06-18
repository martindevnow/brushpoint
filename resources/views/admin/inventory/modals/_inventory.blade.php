<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inventoryModal">New Inventory</button>

<div class="modal fade" id="inventoryModal" tabindex="-1" role="dialog" aria-labelledby="inventoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="inventoryModalLabel">New Inventory</h4>
      </div>
      {!! Form::open(['method' => 'post', 'url' => ['admins/inventory/store'], 'id'=>'inventory_form']) !!}
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
              {!! Form::text('expiry_date', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              {!! Form::label('quantity', 'Quantity:') !!}
              {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              {!! Form::label('description', 'Description:') !!}
              {!! Form::text('description', 'available', ['class' => 'form-control']) !!}
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