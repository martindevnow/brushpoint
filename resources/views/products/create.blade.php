@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">List a New Product</h1>
    </div>
    <!-- /.col-lg-12 -->



    <div class="row">
        <div class="col-lg-12">
        
        @include('errors.list')

        {!! Form::open() !!}
            <!-- Name Form Input -->
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Description Form Input -->
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::text('description', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Sku Form Input -->
            <div class="form-group">
                {!! Form::label('sku', 'Sku:') !!}
                {!! Form::text('sku', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Price Form Input -->
            <div class="form-group">
                {!! Form::label('price', 'Price:') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Picture Form Input -->
            <div class="form-group">
                {!! Form::label('picture', 'Picture:') !!}
                {!! Form::file('picture', null, ['class' => 'form-control']) !!}
            </div>

            <!--  Form Input -->
            <div class="form-group">
                {!! Form::checkbox('active', false, ['class' => 'form-control']) !!}
                {!! Form::label('active', 'Active') !!}
            </div>

            <!--  Form Input -->
            <div class="form-group">
                {!! Form::checkbox('portfolio', false, ['class' => 'form-control']) !!}
                {!! Form::label('portfolio', 'Portfolio') !!}
            </div>

            <!--  Form Input -->
            <div class="form-group">
                {!! Form::checkbox('purcahse', false, ['class' => 'form-control']) !!}
                {!! Form::label('purchase', 'Purchase') !!}
            </div>


            <!-- List the new Item Form Input -->
            <div class="form-group">
                {!! Form::submit('List the new Item', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        {!! Form::close() !!}


        </div>
    </div>

</div>

@stop