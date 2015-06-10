<html lang="en">
  <head>
    <title>BrushPoint Invoice</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">

    <style>
    * {
        /*border: 1px solid black;*/
    }
    .body {
        font-size: 16px;
        padding-top: 15px;
        width: 850px;
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
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
    }
    .sub-table-value {
        text-align: right;
        padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
    }

    .address-name {
        font-size: 18px;
    }

    .invoice-footer-top > p
    {
        width: 100%;
        text-align: center;
        /*position: absolute;*/

    }

    table>tbody>tr>td .blank-cell {
        border-top: none;
    }

    table>thead>tr>th .blank-cell {
        border-bottom: none;
    }

    </style>
  </head>
  <body>


    @yield('content')

  </body>
</html>
