<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#virtueModal">New Virtue</button>

<div class="modal fade" id="virtueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Virtue</h4>
      </div>
      {!! Form::open(['data-remote', 'method' => 'post', 'url' => ['admins/virtues/store'], 'id' => 'virtue_ajax_form']) !!}
      <div class="modal-body">
          <div class="form-group">
              {!! Form::label('type', 'Type:') !!}
              {!! Form::select('type', ['feature' => 'Feature', 'benefit' => 'Benefit', 'other' => 'Other'], ['class' => 'form-control']) !!}

              {!! Form::label('body', 'Body:') !!}
              {!! Form::text('body', null, ['class' => 'form-control']) !!}
              {!! Form::hidden('product_id', $product->id) !!}

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