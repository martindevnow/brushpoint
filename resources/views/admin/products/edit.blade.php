@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">

            {!! Form::open(['method' => 'patch', 'route' => ['admins.products.update', $product->id]]) !!}

            <!-- Save Form Input -->
            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', $product->description, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('sku', 'SKU:') !!}
                {!! Form::text('sku', $product->sku, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Price:') !!}
                {!! Form::text('price', $product->price, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('on_hand', 'On Hand:') !!}
                {!! Form::text('on_hand', $product->on_hand, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('benefits', 'Benefits:') !!}
                {!! Form::textarea('benefits', $product->getBenefitsText(), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('features', 'Features:') !!}
                {!! Form::textarea('features', $product->getFeaturesText(), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('claim', 'Claim:') !!}
                {!! Form::text('claim', $product->claim, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('other', 'Other:') !!}
                {!! Form::text('other', $product->other, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('other_list', 'Other List:') !!}
                {!! Form::textarea('other_list', $product->getOtherListText(), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('link_to_video', 'Link to Video:') !!}
                {!! Form::text('link_to_video', $product->link_to_video, ['class' => 'form-control']) !!}
            </div>



            <div class="form-group">
                {!! Form::label('active', 'Active:') !!}
                {!! Form::checkbox('active', $product->active, $product->active) !!}
            </div>

            <div class="form-group">
                {!! Form::label('portfolio', 'Portfolio (Display):') !!}
                {!! Form::checkbox('portfolio', $product->portfolio, $product->portfolio) !!}
            </div>

            <div class="form-group">
                {!! Form::label('purchase', 'Purchase(able):') !!}
                {!! Form::checkbox('purchase', $product->purchase, $product->purchase) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <td>Images</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product->images as $image)
                    <tr>
                        <td><img src="{{$image->path}}" /></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>


            {{{ var_dump($product->images) }}}

        </div>
    </div>
</div>


@stop