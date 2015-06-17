<button type="button" class="btn btn-sale" data-toggle="modal" data-target="#reportModal">New Report</button>
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Report</h4>
      </div>
        {!! Form::open([
            'method' => 'post',
            'files' => true,
            'url' => 'admins/investigations/report/store',
            'id'=>'report_ajax_form']) !!}
      <div class="modal-body">
          <div class="form-group">
              {!! Form::label('investigation_report', 'File:') !!}
              {!! Form::file('investigation_report') !!}
          </div>
      </div>
            {!! Form::hidden('investigation_id', $investigation->id) !!}
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>