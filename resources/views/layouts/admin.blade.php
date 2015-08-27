<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{{ Session::token() }}}">

    <title>BrushPoint - Administration</title>

    <!-- Bootstrap Core CSS -->
    <link href="/admin/sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/admin/sb-admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/admin/sb-admin/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/admin/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/admin/sb-admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/admin/sb-admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    <!-- DataTables CSS -->
    <link href="/admin/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/admin/sb-admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/admin/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <style>
    .flash {
        background: #F6624a;
        color: #ffffff;
        width: 200px;
        position: absolute;
        right: 20px;
        bottom: 20px;
        padding: 1em;
        display: none;
    }
    .form-table
    {
        width: 100%;
    }
    .container {
        width: 100%;
    }

    .sortable_list {
        display: block;
        margin: 5px;
        padding: 5px;
        border: 1px solid #cccccc;
        color: #0088cc;
        background: #eeeeee;
    }

    .virtue_list {
        padding-left: 0px;
    }

    .del_button {
        display: inline;
        float: right;
    }

    .btn-clear-all {
        color: #fff;
        background-color: #F04E4E;
        border-color: #D81818;
        margin-top: -3px;
        padding: 2px 10px;
    }

    .btn-panel-heading {
        margin-top: -3px;
        padding: 2px 10px;
    }

    .btn-focus {
        color: #fff;
        background-color: #cd3297;
        border-color: #a31d69;
    }
    
    .page-header {
        margin-top: 15px;

    }

    .btn-unchecked {
        color: #fff;
        background-color: #cd3297;
        border-color: #a31d69;
    }

    .btn-checked {
        color: #000;
        background-color: #8bf292;
        border-color: #3aa333;
    }

    .btn-close {
        content: "Close";
    }

    .btn-closed {
        content: "Closed";
    }

    .btn-unchecked:hover .fa-times:before {
        content:"\f00c";
    }

    .btn-checked:hover .fa-check:before {
        content:"\f00d";
    }

    .btn-checked:hover {
        color: #fff;
        background-color: #cd3297;
        border-color: #a31d69;
    }

    .btn-unchecked:hover {
        color: #000;
        background-color: #8bf292;
        border-color: #3aa333;
    }

    /*input.toggle[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }

    input.toggle[type="checkbox"]:checked + label {
            background-color: #DDE3ED;
            color:  #333;
    }

    input.toggle[type="checkbox"]:hover, :focus, :active + label {
        background-color: #eee;
        background-color: #DDE3ED;
        color:  #333;
    }

    input.toggle[type="checkbox"] + label {
        display: block;
        padding: .4em .8em;
        color: #fff;
        background-color: #444;
    }

    input.toggle[type="checkbox"] :hover, :focus, :active + label {
        background-color: #DDE3ED;
        color:  #333;
    }*/

    .btn-101 {
        max-width: 101px;
        width: 101px;
        text-align: left;
    }
    </style>

@yield('admin_head')

</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.nav')

        <div id="page-wrapper">
            <div class="container">
                <div class="row">
                    @include('layouts.partials._flash')
                </div>
            </div>
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/admin/sb-admin/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/js/jquery-ui.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/admin/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/admin/sb-admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="/admin/sb-admin/bower_components/raphael/raphael-min.js"></script>
        <script src="/admin/sb-admin/bower_components/morrisjs/morris.min.js"></script>
        <script src="/admin/sb-admin/js/morris-data.js"></script>   -->

    <!-- Custom Theme JavaScript -->
    <script src="/admin/sb-admin/dist/js/sb-admin-2.js"></script>
    <script src="/js/all.js"></script>

    <script>
    $('#noteModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    </script>
    <script>
    $(".btn-unchecked").hover(
      function () {
        $(this).addClass("btn-checked");
      },
      function () {
        $(this).removeClass("btn-checked");
      }
    );

    $(".btn-checked").hover(
      function () {
        //$(this).addClass("btn-unchecked");
        // $(this).removeClass("btn-checked");
      },
      function () {
        //$(this).removeClass("btn-unchecked");
        // $(this).addClass("btn-checked");
      }
    );
    </script>
</body>

</html>
