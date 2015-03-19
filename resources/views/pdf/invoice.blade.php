<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BrushPoint Invoice</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://bpl5.dev/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="http://bpl5.dev/css/bootstrap-theme.min.css">

    <style>

    .body {
        font-size: 16px;
        padding-top: 15px;
    }

    .container {
        width: 760px;
    }
    .invoice-address {
        float: right;
        border: 1px solid darkblue;
        padding: 10px 25px 10px 25px;
        width: 100%;
    }
    .sub-table-strong {

    }
    .sub-table-value {
        text-align: right;;
    }

    .invoice-footer-top > p
    {
        width: 100%;
        text-align: center;
        /*position: absolute;*/

    }

    </style>
  </head>
  <body>


    @yield('content')

  </body>
</html>
