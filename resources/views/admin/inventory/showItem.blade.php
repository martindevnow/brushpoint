@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Inventory</h1>

            <p>Current "OnHand": {{$item->on_hand}}</p>

            <a href="/admins/inventory/create" class="btn btn-primary" style="float: right;">New Inventory</a>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
             {!!  $inventories->render() !!}
        </div>
    </div>
    <table class="table form-table">
        <thead>
            <tr>
              <th>SKU</th>
              <th>Lot Code</th>
              <th>Original</th>
              <th>Remaining</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($inventories as $inventory)
            <tr>
              <td><a href="/admins/inventory/item/{{ $inventory->item_id }}">{{ $inventory->item->sku }}</a></td>
              <td>{{ $inventory->lot_code }}</td>
              <td>{{ $inventory->original_quantity }}</td>
              <td>{{ $inventory->quantity }}</td>
              <td>{{ $inventory->status }}</td>
              <td>
                {{--{{ dd($inventory) }}--}}
                @if ($inventory->isOnHold())
                <a href="/admins/inventory/activate/{{ $inventory->id }}">
                    <button type="button" class="btn btn-primary btn-xs confirm_action" style="float: right;">
                        Activate
                    </button>
                </a>
                @else
                <a href="/admins/inventory/hold/{{ $inventory->id }}">
                    <button type="button" class="btn btn-danger btn-xs confirm_action" style="float: right;">
                        Put On Hold
                    </button>
                </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
    </table>

    {!!  $inventories->render() !!}
</div>
<div class="flash">
    Updated...
</div>

@stop