
<div class="row">
@foreach($notes as $note)

<div class="col-lg-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{ $note->created_at->toDateTimeString() }}
        </div>
        <div class="panel-body">
            <p>{{ $note->content }}</p>
        </div>
        <div class="panel-footer">
            Made by {{ $note->user->name }}
        </div>
    </div>
</div>
@endforeach
</div>