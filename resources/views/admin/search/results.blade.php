@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">
            Results
            </h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
            Feedback
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