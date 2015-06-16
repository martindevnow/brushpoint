<?php
$headerData['pageTitle'] = 'BrushPoint Feedback: ' .$feedback->id;

$titleData['title'] = 'New Feedback Received';
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
                        @include('emails.partials.title', $titleData)

                        <!-- Customer Greeting -->
                        <tr>
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif; border-bottom: 1px solid rgb(234,234,234); padding-bottom: 5px;">
                            <h2>Thank you for your feedback!</h2>
                                <p>
                                This is a notification to let you know that we have received your product feedback.
                                </p>
                                <p>
                                Thank you for contacting BrushPoint Innovations Inc.
                                </p>
                                <p>
                                One of our representatives will be contacting you within several days.
                                </p>
                                <p>
                                Thank you for your patience.
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
                                    <td>Intent: </td>
                                    <td>{{ $feedback->intent }}</td>
                                </tr>
                                <tr>
                                    <td>Message: </td>
                                    <td>{{ $feedback->issue_text }}</td>
                                </tr>
                            </table>
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