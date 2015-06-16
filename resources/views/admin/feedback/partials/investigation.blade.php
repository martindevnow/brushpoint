<div class="col-lg-4">
    <div class="panel panel-info">
        <div class="panel-heading">
            Investigation Created At: {{ $investigation->created_at->toDateTimeString() }}

        </div>
        <div class="panel-body">
            <p>Field Sample Requested At: {{ $investigation->field_sample_requested_at }}</p>
            @if($investigation->field_sample_received)
                <p>Field Sample Received At: {{ $investigation->field_sample_received_at }}</p>
                <p>Issue was closed in {{ ($investigation->field_sample_requested_at->diffForHumans($investigation->field_sample_received_at)) }}</p>
            @else
                {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/investigations/ajax/'. $investigation->id .'?field=field_sample_received' ]) !!}
                <div class="form-group">
                    {!! Form::label('field_sample_received', 'Field Sample Received:') !!}
                    {!! Form::checkbox('field_sample_received', $investigation->field_sample_received, $investigation->field_sample_received, ['data-click-submits-form']) !!}
                </div>
                {!! Form::close() !!}
            @endif

        </div>
        <div class="panel-footer">
            Investigation Opened by {{ $investigation->user->name }}
        </div>
    </div>
</div>

<div class="flash">
    Updated...
</div>