<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            body,td,div,p,a,input {font-family: arial, sans-serif;}
        </style>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BrushPoint.com Feedback - {{ time() }}</title>
        <style type="text/css">
            body, td {font-size:13px} a:link, a:active {color:#1155CC; text-decoration:none} a:hover {text-decoration:underline; cursor: pointer} a:visited{color:##6611CC} img{border:0px} pre { white-space: pre; white-space: -moz-pre-wrap; white-space: -o-pre-wrap; white-space: pre-wrap; word-wrap: break-word; max-width: 800px; overflow: auto;}
        </style>
    </head>
    <body>
        <div class="body-container" style="width: 600px; margin-right: auto; margin-left: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                    <table style="width:100%;border-collapse:collapse">
                        <tbody>
                        <!-- Top Bar and General Information -->
                        <tr>
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                <table style="width:100%;border-collapse:collapse">
                                <tbody>
                                <tr>
                                    <td rowspan="2" style="width:115px;padding:20px 20px 0 0;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <a href="http://www.brushpoint.com" title="Visit www.brushpoint.com" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            <img src="http://www.brushpoint.com/images/logo/brushpoint.jpg" height="75" width="165" />
                                            <!-- <img alt="BrushPoint.com" src="https://ci6.googleusercontent.com/proxy/WhmqLoMir5UYEN_mqZBtoDGctziWnxcd16JUuejFgylJH9MjVIUKe8NP3fxPs7ww8j41WBvy-JQKspLrhrPKLmmCwBuHQcWhwm7oPls8g7VZtkb0JoBGh-TAQx2I=s0-d-e1-ft#http://g-ec2.images-amazon.com/images/G/15/x-locale/cs/te/a_ca_logo.png" style="border:0;width:115px"> -->
                                        </a>
                                    </td>
                                    <td style="text-align:right;padding:5px 0;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif"> </td>
                                    <td style="width:100%;padding:7px 5px 0;text-align:right;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif"> </td>
                                    <td style="text-align:right;padding:5px 0;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">

                                        <a href="http://www.brushpoint.com" style="border:0;margin:0;padding:0;border-right:0px solid rgb(204,204,204);margin-right:0px;padding-right:0px;text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            BrushPoint.com
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:right;padding:7px 0 5px 0;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <h2 style="font-size:20px;line-height:24px;margin:0;padding:0;font-weight:normal;color:rgb(0,0,0)!important">
                                            New Feedback Received
                                        </h2>
                                        Feedback ID#: <a href="{{ url('/') }}/admins/feedback/{{ $feedback->id }}">{{ $feedback->id }} [VIEW]</a>
                                        <br>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>

                        <!-- Customer Greeting -->
                        <tr>
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">

                                <h2>Feedback From: {{ $feedback->name }}</h2>

                                <p>
                                    <a href="{{ url('/') }}/admins/feedback/{{ $feedback->id }}">View it here.</a>
                                </p>

                                <table>
                                <tr>
                                    <td>Name: </td>
                                    <td>{{ $feedback->name }}</td>
                                </tr>
                                <tr>
                                    <td>Date: </td>
                                    <td>{{ $feedback->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                                    <td>{{ $feedback->email }}</td>
                                </tr>
                                <tr>
                                    <td>Retailer: </td>
                                    <td>{{ $feedback->retailer_text }}</td>
                                </tr>
                                <tr>
                                    <td>Lot Code: </td>
                                    <td>{{ $feedback->lot_code }}</td>
                                </tr>
                                <tr>
                                    <td>Issue: </td>
                                    <td>{{ $feedback->issue_text }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>