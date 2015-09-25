@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Email Templates</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>

    <div class="row">
        <div class="col-ld-2"></div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Internal Emails (Company)
                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">
                @foreach($internalEmailLinks as $emailLink)
                    <a href="#"
                        onclick="window.open( '{{ url('/') . '/admins/emails/'. $emailLink['scope'] . '/' . $emailLink['type'] }}', 'name', 'location=no,scrollbars=yes,status=no,toolbar=yes,resizable=yes' )"
                        class="list-group-item"
                        >
                            {{ $emailLink['title'] }}
                            <span class="pull-right text-muted small">
                            <em>View</em></span>
                        </a>
                    @endforeach
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> External Emails (Customers)
                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">
                @foreach($externalEmailLinks as $emailLink)
                    <a href="#"
                        onclick="window.open( '{{ url('/') . '/admins/emails/'. $emailLink['scope'] . '/' . $emailLink['type'] }}', 'name', 'location=no,scrollbars=yes,status=no,toolbar=yes,resizable=yes' )"
                        class="list-group-item"
                        >
                            {{ $emailLink['title'] }}
                            <span class="pull-right text-muted small">
                            <em>View</em></span>
                        </a>
                    @endforeach
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
    </div>

<div class="flash">
    Updated...
</div>

@stop




