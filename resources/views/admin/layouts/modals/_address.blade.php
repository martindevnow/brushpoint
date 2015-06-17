<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addressModal">New Address</button>

<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addressModalLabel">New Address</h4>
      </div>
      {!! Form::open(['data-remote', 'method' => 'post', 'url' => ['admins/addresses/store'], 'id'=>'address_ajax_form']) !!}
      <div class="modal-body">
          @include('layouts.partials._address')
      </div>
      {!! Form::hidden('class', get_class($model)) !!}
      {!! Form::hidden('addressable_id', $model->id) !!}
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>