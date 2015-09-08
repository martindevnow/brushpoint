<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Retailer</th>
          <th>Retailer Code</th>
          <th>Lot Code</th>
          <th>Issue</th>
          <th>Intent</th>
          <th>Received</th>
          <th>Closed</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($feedbacks as $feedback)
        <tr>
          <td>{{ $feedback->id }}</td>
          <td>{{ $feedback->name }}</td>
          @if(isset($feedback->retailer_id))
            <td><a href="/admins/retailers/{{ $feedback->retailer->id }}">{{ $feedback->retailer->name }}</a></td>
          @else
            <td>{{ $feedback->retailer_text }}</td>
          @endif
          <td>{{ $feedback->retailer_reference }}</td>
          <td>{{ $feedback->lot_code }}</td>
          <td>{{ str_limit($feedback->issue_text, 150) }}</td>
          <td>{{ $feedback->intent }}</td>
          <td>{{ $feedback->created_at->diffForHumans() }}</td>
          <td>
              @if($feedback->closed_at != "0000-00-00 00:00:00" && $feedback->closed_at != "-0001-11-30 00:00:00")
                {{ $feedback->closed_at }}
              @else
                  <div>
                    {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id . '?field=closed']) !!}
                    {{--{!! Form::checkbox('closed', $feedback->closed, $feedback->closed, ['data-click-submits-form', 'class' => 'toggle']) !!}--}}
                    <input name="closed" data-click-submits-form class="toggle" id="closed-{{ $feedback->id }}" type="checkbox" value="0">
                    <label for="closed-{{ $feedback->id }}">Closed</label>
                    {!! Form::close() !!}
                  </div>
              @endif
          </td>
          <td>
              <a href="/admins/feedback/{{ $feedback->id }}">
              <button class="btn btn-primary"><i class="fa fa-search "></i></button>
              </a>
          </td>

          <td>
            <form method="POST" action="/admins/feedback/{{ $feedback->id }}" accept-charset="UTF-8"
                onsubmit="return confirm('Do you really wish to delete that??');">
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
</table>