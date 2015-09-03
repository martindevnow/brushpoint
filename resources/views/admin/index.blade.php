@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">BrushPoint Administration</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-4 col-md-4">
    @include('admin.layouts.modules._feedback')
    </div>
    <div class="col-lg-4 col-md-4">
    @include('admin.layouts.modules._payments')
    </div>

    <div class="col-lg-4 col-md-4">
        @include('admin.layouts.modules._attentions')
    </div>
</div>
@stop