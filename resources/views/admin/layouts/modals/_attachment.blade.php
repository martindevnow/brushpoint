<button type="button" class="btn btn-primary {{ ( isset($class) ? $class : "" ) }}" data-toggle="modal" data-target="#attachmentModal"><i class="fa fa-upload"></i> </button>

<div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Attachment</h4>
      </div>
      {!! Form::open([
            'files' => true,
            'method' => 'post',
            'url'   => 'admins/attachments/store',
            'id'    =>'attachment_ajax_form'
      ]) !!}
      <div class="modal-body">
          <div class="form-group">
              {!! Form::label('body', 'Content:') !!}
              {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              {!! Form::label('attachment_file', 'File:') !!}
              {!! Form::file('attachment_file') !!}
          </div>
      </div>
      {!! Form::hidden('attachmentable_class', get_class($model)) !!}
      {!! Form::hidden('attachmentable_id', $model->id) !!}
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>