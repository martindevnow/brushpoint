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
                Inventory for {{ $item->sku }}
                <a href="/admins/inventory/item/{{ $item->id }}/create" style="float: right;">
                    <button class="btn btn-primary btn-panel-heading btn-primary">Create</button>
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
                </div>
            </div>
        </div>
    </div>
    {!!  $inventories->render() !!}
</div>
<div class="flash">
    Updated...
</div>

@stop