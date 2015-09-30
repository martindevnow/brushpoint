@if($feedback->addresses->first())
<div class="col-lg-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Sent to Customer: {{ $customerRequest->sent_at }}
        </div>
        <div class="panel-body">
            <h4>Received From Customer: {{ $customerRequest->received_at }}</h4>
            @if($customerRequest->images->count() > 0)
                @foreach($customerRequest->images as $image)
                    <a href="{{ $image->adminDownloadLink() }}" title="Download Image {{ $image->file_name }}">Download [{{ $image->file_name }}]</a><br />
                @endforeach
            @endif

        </div>
        <div class="panel-footer">
            Requested by: {{ $customerRequest->user->name }}
        </div>
    </div>
</div>
@endif

