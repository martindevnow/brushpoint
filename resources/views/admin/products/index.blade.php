@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Products</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
             {!!  $products->render() !!}
        </div>
    </div>

<div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Products
                <a href="/admins/products/create" style="float: right;">
                    <button class="btn btn-primary btn-panel-heading btn-focus">Create</button>
                </a>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>Item</th>
                              <th>SKU</th>
                              <th>Edit</th>
                              <th>Activate</th>
                              <th>Display</th>
                              <th>Purchase</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($products as $product)
                            <tr>
                              <td>{{ $product->name }}</td>
                              <td>{{ $product->sku }}</td>
                              <td>
                                <a href="/admins/products/{{ $product->id }}/edit">
                                    <button class="btn btn-warning">Edit</button>
                                </a></td>
                              <td>
                                <div class="form-group">
                                    {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/products/ajax/'. $product->id .'?field=active']) !!}
                                    {!! Form::checkbox('active', $product->active, $product->active, ['data-click-submits-form']) !!}
                                    {!! Form::close() !!}
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                    {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/products/ajax/'. $product->id. '?field=portfolio']) !!}
                                    {!! Form::checkbox('portfolio', $product->portfolio, $product->portfolio, ['data-click-submits-form']) !!}
                                    {!! Form::close() !!}
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                    {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/products/ajax/'. $product->id .'?field=purchase']) !!}
                                    {!! Form::checkbox('purchase', $product->purchase, $product->purchase, ['data-click-submits-form']) !!}
                                    {!! Form::close() !!}
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flash">
    Updated...
</div>

@stop