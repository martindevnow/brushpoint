<button type="button" class="btn btn-primary btn-101 {{ ( isset($class) ? $class : "" ) }}"
data-toggle="modal" data-target="#noteModal">
<i class="fa fa-file-text"></i>
&nbsp; Note
</button>

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New note</h4>
      </div>
      {!! Form::open(['data-remote', 'method' => 'post', 'url' => ['admins/notes/store'], 'id'=>'note_ajax_form']) !!}
      <div class="modal-body">
          <div class="form-group">
              {!! Form::label('body', 'Content:') !!}
              {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
          </div>
      </div>
      {!! Form::hidden('class', get_class($model)) !!}
      {!! Form::hidden('noteable_id', $model->id) !!}
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>