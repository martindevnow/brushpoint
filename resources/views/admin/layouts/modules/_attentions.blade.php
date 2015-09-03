<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell fa-fw"></i> Notifications Panel
        <a href="/admins/attentions/clearAll" style="float: right;">
            <button class="btn btn-clear-all">Clear All</button>
        </a>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="list-group">
            <?php $attentions = $attentionRepo->getLatestUnseen(15);
            ?>
            @foreach ($attentions as $attention)
            <span class="pull-left">
                <a href="/admins/attentions/remove/{{ $attention->id }}">
                    <i class="fa fa-times-circle" style="font-size: 1.4em;
                                                             padding: 10px 0px 0px 0px;
                                                             color: #A40000;
                                                         "> </i>
                </a>
            </span>
            <a href="{{ $attention->getUrl() }}" class="list-group-item" style="margin-left: 25px">
                {!! $attention->getITag() !!}
                <span class="pull-right text-muted small">
                    <em>{{ $attention->created_at->diffForHumans() }}

                    </em>
                </span>
            </a>
            @endforeach
        </div>
        <!-- /.list-group -->
        <a href="#" class="btn btn-default btn-block">View All Alerts</a>
    </div>
    <!-- /.panel-body -->
</div>
