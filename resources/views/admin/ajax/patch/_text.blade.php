<button type="button" class="btn btn-primary {{ ( isset($modal['class']) ? $modal['class'] : "" ) }}"
data-toggle="modal" data-target="#{{ $modal['lc_name'] }}Modal"><i class="fa {{ $modal['icon'] }}"></i>{{ $modal['button_text'] }}</button>

<div class="modal fade" id="{{ $modal['lc_name'] }}Modal" tabindex="-1" role="dialog" aria-labelledby="{{ $modal['lc_name'] }}ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="{{ $modal['lc_name'] }}ModalLabel">New {{ $modal['name'] }}</h4>
      </div>
      {!! Form::open([
            'data-remote',
            'method' => $modal['method'],
            'url' => [
                $modal['url']
            ]
      ]) !!}
      <div class="modal-body">
          <div class="form-group">
                {!! Form::hidden('field', $modal['field']) !!}

              {!! Form::label('value', $modal['field_label']) !!}
              {!! Form::text('value', $modal['field_value'], ['class' => 'form-control']) !!}
              @if($modal['model_key'])
                  {!! Form::hidden($modal['model_key'], $modal['model_value']) !!}
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

