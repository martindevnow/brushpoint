@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">BrushPoint Administration</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-6">

        <div class="panel panel-default">
            <div class="panel-heading">
            Run Reports
            </div>

            <div class="panel-body">

                <form method="post" action="/admins/reports/run">
                    From: {!! Form::selectMonth('from_month', date('n')) !!}
                    {!! Form::selectRange('from_day', 01, 31) !!}
                    {!! Form::selectRange('from_year', 2015, 2016) !!}
                    <br />
                    To: {!! Form::selectMonth('to_month', date('n')) !!}
                    {!! Form::selectRange('to_day', 01, 31) !!}
                    {!! Form::selectRange('to_year', 2015, 2016) !!}
                    <br />
                    Type: {!! Form::select('report', $viableReports) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {!! Form::submit('Run') !!}
                </form>


            </div>
        </div>













        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell fa-fw"></i> Payment - Reports
            </div>
            <!-- /.panel-heading -->



            <div class="panel-body">
                <a href="/admins/reports/generate/payments" class="list-group-item">
                    Payments - All
                    <span class="pull-right text-muted small">
                        <em>Run</em></span>
                </a>
                <a href="/admins/reports/generate/soldItems" class="list-group-item">
                    Payments - SoldItems
                    <span class="pull-right text-muted small">
                        <em>Run</em></span>
                </a>
            </div>
            <!-- /.panel-body -->
        </div>





        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell fa-fw"></i> Feedback - Reports
            </div>
            <!-- /.panel-heading -->


            <div class="panel-body">
                <a href="/admins/reports/generate/feedback" class="list-group-item">
                    Feedback - All
                    <span class="pull-right text-muted small">
                        <em>Run</em></span>
                </a>
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>





@stop