
<div class="row" id="note_list">
    @foreach($notes as $note)
    <div class="col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                Note: {{ $note->created_at->toDateTimeString() }}
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