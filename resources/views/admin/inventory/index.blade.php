@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Inventory</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
             {!!  $inventories->render() !!}
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Inventory
                <a href="/admins/inventory/create" style="float: right;">
                    <button class="btn btn-primary btn-panel-heading btn-focus">Create</button>
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
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
                            @foreach($inventories as $inventory)
                            <tr>
                              <td><a href="/admins/inventory/item/{{ $inventory->item_id }}">{{ $inventory->item->sku }}</a></td>
                              <td><a href="/admins/inventory/lot/{{ $inventory->id }}">{{ $inventory->lot_code }}</a></td>
                              <td>{{ $inventory->original_quantity }}</td>
                              <td>{{ $inventory->quantity }}</td>
                              <td>{{ $inventory->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {!!  $inventories->render() !!}
                </div>
            </div>
        </div>
    </div>

</div>
<div class="flash">
    Updated...
</div>

@stop