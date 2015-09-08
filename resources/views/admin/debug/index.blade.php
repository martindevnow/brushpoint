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

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell fa-fw"></i> Inventory
            </div>
            <!-- /.panel-heading -->


            <div class="panel-body">
                <a href="/admins/debug/inventory/calculate" class="list-group-item">
                    Recalculate (Update) Current Inventory Levels
                    <span class="pull-right text-muted small">
                        <em>Run</em></span>
                </a>
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>
@stop