<div class="col-lg-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{ $contact->created_at->toDateTimeString() }}
        </div>
        <div class="panel-body">
            <p>{!! $contact->body !!}</p>
        </div>
        <div class="panel-footer">
            Made by {{ $contact->user->name }}
        </div>
    </div>
</div>
