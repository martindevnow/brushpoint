@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Inventory</h1>
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
              <th>Desc</th>
            </tr>
          </thead>
          <tbody>
            @foreach($inventories as $inventory)
            <tr>
              <td><a href="/admins/inventory/item/{{ $inventory->item_id }}">{{ $inventory->item->sku }}</a></td>
              <td><a href="/admins/inventory/lot/{{ $inventory->id }}">{{ $inventory->lot_code }}</a></td>
              <td>{{ $inventory->original_quantity }}</td>
              <td>{{ $inventory->quantity }}</td>
              <td>{{ $inventory->description }}</td>
            </tr>
            @endforeach
          </tbody>
    </table>
    {!!  $inventories->render() !!}

    <a href="/admins/inventory/create"><button class="btn btn-primary">Add New Inventory</button></a>
    {{--@include('admin.inventory.modals._inventory', ['itemListByIdName' => $itemListByIdName])--}}

</div>
<div class="flash">
    Updated...
</div>

@stop