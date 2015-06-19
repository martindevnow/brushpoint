@foreach ($items as $item)
<div class="form-group">
    {!! Form::label('item_'. $item->id, $item->sku) !!}
    {!! Form::text('item_'. $item->id, null, ['class' => 'form-control']) !!}
</div>
@endforeach