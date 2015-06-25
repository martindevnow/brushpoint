@if($product->items()->count() > 1)
    <select class="addToCart-form" name="item_id">
        @foreach($product->items as $item)
            <option value="{{ $item->id }}" {{ $item->on_hand ? "" : "disabled" }}>{{ $item->variance }}{{ $item->on_hand ? "" : " [Sold Out]" }}</option>
        @endforeach
    </select>


    {{--{!! Form::select('item_id', $product->items()->lists('variance', 'id'), null, ['class' => 'addToCart-form']) !!}--}}
@else
    {!! Form::hidden('item_id', $product->items[0]->id) !!}
@endif
    {!! Form::selectRange('quantity', 1, 10, null, ['class' => 'addToCart-form']) !!}
    {!! Form::submit('Add to Cart', ['class'=> 'btn btn-sale', 'style' => 'margin-top: 6px;']) !!}