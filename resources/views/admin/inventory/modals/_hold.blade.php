@if ($inventory->isOnHold())
<a href="/admins/inventory/activate/{{ $inventory->id }}">
    <button type="button" class="btn btn-primary confirm_action">
        <i class="fa fa-play"></i>
    </button>
</a>
@else
<a href="/admins/inventory/hold/{{ $inventory->id }}">
    <button type="button" class="btn btn-danger confirm_action">
        <i class="fa fa-pause"></i>
    </button>
</a>
@endif