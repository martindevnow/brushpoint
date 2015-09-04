@extends('layouts.admin')
@section('admin_head')
<style>

</style>


@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">
            Feedback
            </h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
             {!!  $feedbacks->render() !!}
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{--Feedback--}} &nbsp;
                <a href="/admins/feedback/create" style="float: right;">
                    <button class="btn btn-primary btn-panel-heading btn-primary">Create</button>
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @include('admin.feedback._table', ['feedbacks' => $feedbacks])
                </div>
            </div>
        </div>
    </div>
    {!!  $feedbacks->render() !!}
</div>
<div class="flash">
    Updated...
</div>

@stop