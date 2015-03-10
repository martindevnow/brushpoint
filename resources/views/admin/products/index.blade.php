@extends('layouts.admin')

@section('content')
<div class="container">

    <table class="table">
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
              <td><a href="/admins/products/{{ $product->id }}">Edit</a></td>
              <td>
              {!! Form::open() !!}
                  <div class="form-group">
                  {!! Form::checkbox('active', $product->active, $product->active) !!}
                  </div>
              {!! Form::close() !!}
              </td>
              <td>
                {!! Form::open() !!}
                    <div class="form-group">
                    {!! Form::checkbox('portfolio', $product->portfolio, $product->portfolio) !!}
                    </div>
                {!! Form::close() !!}
              </td>
              <td>
                {!! Form::open() !!}
                    <div class="form-group">
                    {!! Form::checkbox('purchase', $product->purchase, $product->purchase) !!}
                    </div>
                {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>


@stop