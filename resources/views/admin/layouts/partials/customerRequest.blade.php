@if($feedback->addresses->first())
<div class="col-lg-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Sent to Customer: {{ $customerRequest->sent_at }}
        </div>
        <div class="panel-body">
            <h4>Received From Customer: {{ $customerRequest->received_at }}</h4>
            <p>{!! $customerRequest->feedback->addresses->first()->toString() !!}</p>
        </div>
        <div class="panel-footer">
            Requested by: {{ $customerRequest->user->name }}
        </div>
    </div>
</div>
@endif

