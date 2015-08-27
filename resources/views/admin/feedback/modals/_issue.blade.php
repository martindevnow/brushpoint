<button type="button" class="btn btn-primary {{ ( isset($class) ? $class : "" ) }}" data-toggle="modal" data-target="#issueModal"><i class="fa fa-exclamation"></i></button>

<div class="modal fade" id="issueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Issue</h4>
      </div>
      {!! Form::open(['data-remote', 'method' => 'post', 'url' => ['admins/issues/store']]) !!}
      <div class="modal-body">
          <div class="form-group">
              {!! Form::label('type', 'Label:') !!}
              {!! Form::text('type', null, ['class' => 'form-control']) !!}
              {!! Form::label('complaint', 'Complaint:') !!}
              {!! Form::checkbox('complaint', null, null, ['class' => 'form-control']) !!}
              @if($feedback)
                  {!! Form::hidden('feedback_id', $feedback->id) !!}
              @endif

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