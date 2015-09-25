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
                    <table class="table table-striped table-bordered table-hover" >
                        <tbody>
                            <tr>
                                <td>From</td>
                                <td>
                                    {!! Form::selectMonth('from_month', date('n')) !!}
                                    {!! Form::selectRange('from_day', 01, 31) !!}
                                    {!! Form::selectRange('from_year', 2015, 2016) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>To</td>
                                <td>
                                    {!! Form::selectMonth('to_month', date('n')) !!}
                                    {!! Form::selectRange('to_day', 01, 31) !!}
                                    {!! Form::selectRange('to_year', 2015, 2016) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>
                                    {!! Form::select('report', $viableReports) !!}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">{!! Form::submit('Run') !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>





@stop