<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/admins">BrushPoint Admin Panel</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li>
                    <a href="#">
                        <div>
                            <strong>John Smith</strong>
                            <span class="pull-right text-muted">
                                <em>Yesterday</em>
                            </span>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>Read All Messages</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-tasks">
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 1</strong>
                                <span class="pull-right text-muted">40% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 2</strong>
                                <span class="pull-right text-muted">20% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 3</strong>
                                <span class="pull-right text-muted">60% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                    <span class="sr-only">60% Complete (warning)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 4</strong>
                                <span class="pull-right text-muted">80% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Tasks</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-tasks -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
            <?php $attentions = $attentionRepo->getLatestUnseen();  ?>
                @if (!$attentions->isEmpty())
                    @foreach ($attentions as $attention)
                        @if ($attention->attentionable != null)
                        <li>
                            <a href="{{ $attention->getUrl() }}">
                                <div>
                                    {!! $attention->getITag() !!}
                                    <span class="pull-right text-muted small">{{ $attention->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        </li>
                        @endif
                    @endforeach
                @else
                <li>
                    <div>
                        <i>None</i>
                    </div>
                </li>
                @endif
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->





<!-- Side Navigation Bar -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    {!! Form::open(['method' => 'get', 'url' => '/admins/search']) !!}
                    <div class="input-group custom-search-form">
                        <input name="search" type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                        </span>
                    </div>
                    {!! Form::close() !!}
                    <!-- /input-group -->

                </li>
                <li>
                    <a href="/admins"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li>
                    <a href="/admins/products"><i class="fa fa-tags fa-fw"></i> Products</a>
                </li>
                <li>
                    <a href=""><i class="fa fa-comments fa-fw"></i> Feedback <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/admins/feedback">All</a>
                        </li>
                        <li>
                            <a href="/admins/feedback/filter?closed=0">Open ({{ $feedbackRepository->getOpenCount() }})</a>
                        </li>
                        <li>
                            <a href="/admins/feedback/filter?closed=1">Closed ({{ $feedbackRepository->getClosedCount() }})</a>
                        </li>
                        <li>
                            <a href="/admins/feedback/create">New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-money fa-fw"></i> Payments <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/admins/payments">All</a>
                        </li>
                        <li>
                            <a href="/admins/payments/filter?shipped=0">Open ({{ $paymentRepository->getOpenCount() }})</a>
                        </li>
                        <li>
                            <a href="/admins/payments/filter?shipped=1">Sent ({{ $paymentRepository->getSentCount() }})</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/admins/payers"><i class="fa fa-group fa-fw"></i> Customers</a>
                </li>
                <li>
                    <a href="/admins/inventory"><i class="fa  fa-barcode fa-fw"></i> Inventory</a>
                </li>
                <li>
                    <a href="/admins/issues"><i class="fa fa-info-circle fa-fw"></i> Issues</a>
                </li>
                <li>
                    <a href="/admins/retailers"><i class="fa fa-shopping-cart fa-fw"></i> Retailers</a>
                </li>
                <li>
                    <a href="/admins/reports"><i class="fa fa-bar-chart-o fa-fw"></i> Reports</a>
                </li>
                <li>
                    <a href="/admins/emails"><i class="fa fa-envelope fa-fw"></i> Email Templates</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
<!-- /.navbar-static-side -->
</nav>