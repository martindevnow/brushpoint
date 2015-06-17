<div class="col-lg-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{ $address->created_at->toDateTimeString() }}
        </div>
        <div class="panel-body">
            <p>{!! $address->toString() !!}</p>
        </div>
        <div class="panel-footer">
            Submitted by {{ $address->user ? $address->user->name : "Customer" }}
        </div>
    </div>
</div>