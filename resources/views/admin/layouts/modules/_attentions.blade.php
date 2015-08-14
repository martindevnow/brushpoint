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


 {{--<a href="/admins/attentions/remove/{{ $attention->id }}">--}}
    {{--<i class="fa fa-times-circle"> </i>--}}
{{--</a>--}}



    {{--{!! Form::open() !!}--}}
    {{--<button class="fa fa-times-circle" style="float:right; background-color: white; border: 0px;"></button>--}}
    {{--{!! Form::close() !!}--}}