<?php
$headerData['pageTitle'] = 'BrushPoint Feedback: ' .$feedback->id;

$titleData['title'] = 'Feedback Update';
$titleData['subtitle'] = 'Feedback ID#: '. $feedback->id;
?>

<html>
    @include('emails.partials.header', $headerData)
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
                                            <img src="{{ url('/') }}/images/logo/brushpoint.jpg" height="75" width="165" />
                                        </a>
                                    </td>
                                    <td style="text-align:right;padding:5px 0;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif"> </td>
                                    <td style="width:100%;padding:7px 5px 0;text-align:right;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                    </td>
                                    <td style="text-align:right;padding:5px 0;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <a href="http://www.brushpoint.com" style="border:0;margin:0;padding:0;border-right:0px solid rgb(204,204,204);margin-right:0px;padding-right:0px;text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            BrushPoint.com
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:right;padding:7px 0 5px 0;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <h2 style="font-size:20px;line-height:24px;margin:0;padding:0;font-weight:normal;color:rgb(0,0,0)!important">
                                            {!! $contact->subject !!}
                                        </h2>
                                        {!! $contact->title !!}
                                        <br>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>

                        <!-- Customer Greeting -->
                        <tr>
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif; border-bottom: 1px solid rgb(234,234,234); padding-bottom: 5px;">
                                {!! $contact->body !!}
                            </td>
                        </tr>
                        @include('emails.partials.footer')
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>