@if($product->items()->count() > 1)
    {!! Form::select('item_id', $product->items()->lists('variance', 'id'), null, ['class' => 'addToCart-form']) !!}
@else
    {!! Form::hidden('item_id', $product->items[0]->id) !!}
@endif
    {!! Form::selectRange('quantity', 1, 10, null, ['class' => 'addToCart-form']) !!}
    {!! Form::submit('Add to Cart', ['class'=> 'btn btn-sale', 'style' => 'margin-top: 6px;']) !!}