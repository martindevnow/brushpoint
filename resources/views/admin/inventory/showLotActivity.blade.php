@extends('layouts.admin')

@section('content')
<div class="container">

    <table class="table form-table">
        <thead>
            <tr>
              <th>SKU</th>
              <th>Lot Code</th>
              <th>Original</th>
              <th>Remaining</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="/admins/inventory/item/{{ $inventory->item_id }}">{{ $inventory->item->sku }}</a></td>
              <td>{{ $inventory->lot_code }}</td>
              <td>{{ $inventory->original_quantity }}</td>
              <td>{{ $inventory->quantity }}</td>
              <td>{{ $inventory->status }}</td>
            </tr>
          </tbody>
    </table>


 <table class="table  form-table">
    <thead>
    <th>Item</th>
    <th>Lot Code</th>
    <th>Quantity</th>
    <th>Cost</th>
    <th>Extended Cost</th>
    </thead>
    <tbody>
        @foreach ($soldItems as $soldItem)
        <tr>
        <td>{{ $soldItem->sku }}</td>
        <td>{{ $soldItem->lot_code }}</td>
        <td>{{ $soldItem->quantity }}</td>
        <td>{{ asMoney($soldItem->price) }}</td>
        <td>{{ asMoney($soldItem->price * $soldItem->quantity) }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>


    @include('admin.layouts.modals._note', ['model' => $inventory])
</div>
@stop