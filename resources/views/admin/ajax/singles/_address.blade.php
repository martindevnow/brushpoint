<div class="col-lg-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Created: {{ $address->created_at->toDateTimeString() }}
            <a href="/admins/addresses/remove/{{ $address->id }}"><button type="button" class="btn btn-danger btn-xs delete_entity" style="float: right;" title="Delete">
                <i class="fa fa-trash"></i>
            </button></a>
        </div>
        <div class="panel-body">
            <p>{{ $address->toString() }}</p>
        </div>
        <div class="panel-footer">
            Submitted by {{ $address->user ? $address->user->name : "Customer" }}
        </div>
    </div>
</div>
