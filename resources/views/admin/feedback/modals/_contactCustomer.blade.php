<button type="button" class="btn btn-primary {{ ( isset($class) ? $class : "" ) }}" data-toggle="modal" data-target="#contactCustomerModal"><i class="fa fa-envelope"></i></button>

<div class="modal fade" id="contactCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Contact Customer</h4>
      </div>
      {!! Form::open(['method' => 'post', 'url' => ['admins/feedback/contact/customer'], 'id'=>'requestRetailerInfo_ajax_form']) !!}
      <div class="modal-body">
          <div class="form-group">
          <label>Please choose the information below to generate the appropriate template for the customer.
          <br />
          You will have a chance to edit and change the email before it is sent.</label>
          </div>
          <div class="form-group">
            {!! Form::label('request_lot_code', 'Request Lot Code:') !!}
            {!! Form::checkbox('request_lot_code', '1', false) !!}
            <div style="padding-left: 25px;">
                {!! Form::label('Rechargeable') !!}
                {!! Form::radio('brush_type', 'rechargeable', false) !!}
                <br />
                {!! Form::label('Battery') !!}
                {!! Form::radio('brush_type', 'battery', false); !!}
            </div>
          </div>

          <!-- Request_address Form Input -->
          <div class="form-group">
              {!! Form::label('request_address', 'Request Address:') !!}
              {!! Form::checkbox('request_address', '1', false) !!}
          </div>

          <!-- Request_lot_code Form Input -->
          <div class="form-group">
              {!! Form::label('request_field_sample', 'Request Field Sample:') !!}
              <p><i>This will open an investigation!</i></p>
              {!! Form::checkbox('request_field_sample', '1', false) !!}
          </div>

          <!-- Request_image Form Input -->
          <div class="form-group">
              {!! Form::label('request_image', 'Request Image:') !!}
              {!! Form::checkbox('request_image', '1', false) !!}
          </div>

          <!-- explain_replacement_head Form Input -->
            <div class="form-group">
                {!! Form::label('explain_replacement_heads_usage', 'Explain Replacement Head Usage:') !!}
                {!! Form::checkbox('explain_replacement_heads_usage', '1', false) !!}
            </div>

          <!-- explain_replacement_head Form Input -->
            <div class="form-group">
                {!! Form::label('explain_interdental_arm', 'Explain Interdental Arm:') !!}
                {!! Form::checkbox('explain_interdental_arm', '1', false) !!}
            </div>

          <!-- explain_replacement_head Form Input -->
            <div class="form-group">
                {!! Form::label('explain_where_to_buy', 'Explain Where To Buy:') !!}
                {!! Form::checkbox('explain_where_to_buy', '1', false) !!}
            </div>

          <!-- explain_replacement_head Form Input -->
            <div class="form-group">
                {!! Form::label('explain_how_to_change_batteries', 'Explain How To Change Batteries:') !!}
                {!! Form::checkbox('explain_how_to_change_batteries', '1', false) !!}
            </div>
      </div>

      {!! Form::hidden('feedback_id', $feedback->id) !!}
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {!! Form::submit('Draft Email', ['class' => 'btn btn-primary button-disappears']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>