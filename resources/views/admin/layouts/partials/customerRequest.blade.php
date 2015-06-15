<div class="col-lg-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Sent: {{ $customerRequest->sent_at }}
        </div>
        <div class="panel-body">
        @if($feedback->addresses->first())
            <h4>Received: {{ $customerRequest->received_at }}</h4>
            <p>{!! $customerRequest->feedback->addresses->first()->toString() !!}</p>
        @endif
        </div>
        <div class="panel-footer">
            Made by {{ $customerRequest->user->name }}
        </div>
    </div>
</div>
