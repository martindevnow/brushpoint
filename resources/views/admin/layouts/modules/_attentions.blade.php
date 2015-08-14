<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell fa-fw"></i> Notifications Panel
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="list-group">
            <?php $attentions = $attentionRepo->getLatestUnseen();
            // dd($attentions);
            ?>
            @foreach ($attentions as $attention)
            <a href="{{ $attention->getUrl() }}" class="list-group-item">
                {!! $attention->getITag() !!}
                <span class="pull-right text-muted small"><em>{{ $attention->created_at->diffForHumans() }}</em>
                </span>
            </a>
            @endforeach
            {{--<a href="#" class="list-group-item">--}}
                {{--<i class="fa fa-money fa-fw"></i> Payment Received--}}
                {{--<span class="pull-right text-muted small"><em>Yesterday</em>--}}
                {{--</span>--}}
            {{--</a>--}}
        </div>
        <!-- /.list-group -->
        <a href="#" class="btn btn-default btn-block">View All Alerts</a>
    </div>
    <!-- /.panel-body -->
</div>