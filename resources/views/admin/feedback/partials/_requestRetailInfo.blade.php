<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#requestRetailerInfoModal">Request Retailer Info</button>

<div class="modal fade" id="requestRetailerInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Request Retailer Info</h4>
      </div>
      {!! Form::open(['data-remote', 'method' => 'post', 'url' => ['admins/feedback/email/requestRetailerInfo'], 'id'=>'requestRetailerInfo_ajax_form']) !!}
      <div class="modal-body">
          <div class="form-group">
          <label>By clicking on the button below, and email will be sent to the customer with a link where they can fill
          out the retailer and lot number with an explanation of where to find that information.</label>
          </div>
          <div class="form-group">
            {!! Form::label('Rechargeable') !!}
            {!! Form::radio('brush_type', 'rechargeable', false) !!}

            {!! Form::label('Battery') !!}
            {!! Form::radio('brush_type', 'battery', false); !!}
          </div>
      </div>

      {!! Form::hidden('feedback_id', $feedback->id) !!}
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {!! Form::submit('Send Email Request', ['class' => 'btn btn-primary button-disappears']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>