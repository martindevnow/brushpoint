@extends('layouts.admin')


@section('admin_head')

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 650px; }
  #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 150px; height: 90px; font-size: 1em; text-align: center; }
  </style>
  <script>
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  </script>
@stop

@section('content')




<div class="container">
    <ol id="sortable" class="product_list" style="width: {{ $numCols * 165 }}px;">
    @foreach ($products as $product)
        <li id="product_{{$product->id}}" class="ui-state-default">{{ $product->name }}
        {!! $product->active ? '' : "<br /><b>[Deactivated]</b>" !!}
        </li>
    @endforeach
    </ol>
</div>

<div class="flash">
    Updated...
</div>

@stop