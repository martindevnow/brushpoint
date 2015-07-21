<div class="col-lg-4">
    <div class="panel panel-info">
        <div class="panel-heading">
            Uploaded At: {{ $attachment->created_at->toDateTimeString() }}
        </div>

        <div class="panel-body">
            <p>{{ $attachment->content }}</p>
            [<a href="/admins/attachments/download/{{ $attachment->id }}"><p class="fa fa-file-pdf-o"> DL </p> - {{ $attachment->file_name }}</a>]
        </div>

        <div class="panel-footer">
            Uploaded by {{ $attachment->user->name }}
        </div>
    </div>
</div>

<div class="flash">
    Updated...
</div>