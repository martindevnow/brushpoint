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
                {!! Form::label('claim', 'Claim:') !!}
                {!! Form::text('claim', $product->claim, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('other', 'Other:') !!}
                {!! Form::text('other', $product->other, ['class' => 'form-control']) !!}
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

            <h3>Virtues:</h3>
            <div class="form-group">
                <h4>List of Benefits</h4>
                <ol id="benefit_list" class="virtue_list benefit_list">
                @foreach($product->benefits as $benefit)
                    <li id="virtue_{{$benefit->id}}" class="sortable_list ui-state-default">{{ ($benefit->body) }}
                    <div class="del-wrapper" style="display: inline"><a href="#" class="del_button" id="del-{{$benefit->id}}">
                    [ x ]</a></div>
                    </li>
                @endforeach
                </ol>
            </div>



            <div class="form-group">
                <h4>List of Features</h4>
                <ol id="feature_list" class="virtue_list feature_list">
                @foreach($product->features as $feature)
                    <li id="virtue_{{$feature->id}}" class="sortable_list ui-state-default">{{ ($feature->body) }}
                    <div class="del-wrapper" style="display: inline"><a href="#" class="del_button" id="del-{{$feature->id}}" >
                    [ x ]</a></div>
                    </li>
                @endforeach
                </ol>
            </div>



            <div class="form-group">
                <h4>List of Others</h4>
                <ol id="other_list" class="virtue_list other_list">
                @foreach($product->others as $other)
                    <li id="virtue_{{$other->id}}" class="sortable_list ui-state-default">{{ ($other->body) }}
                    <div class="del-wrapper" style="display: inline"><a href="#" class="del_button" id="del-{{$other->id}}">
                    [ x ]</a></div>
                    </li>
                @endforeach
                </ol>
            </div>

            <div>
            @include('admin.products.partials._virtues')

            </div>

        </div>
    </div>
</div>

<div class="flash">
    Updated...
</div>
@stop