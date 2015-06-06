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
                        @include('emails.partials.title', $titleData)

                        <!-- Customer Greeting -->
                        <tr>
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif; border-bottom: 1px solid rgb(234,234,234); padding-bottom: 5px;">
                            <h2>Thank you for your feedback!</h2>
                            <p>
                            Thank you for contacting BrushPoint Innovations and providing us with feedback. I do apologize for the defective unit.
                             </p>
                             <p>
                            In order for us to improve on the quality of our products; would you be able to provide us the four digit lot code at the bottom of the toothbrush. Directly underneath where it says 'AA' battery; there is an embossed four digit lot code that is very faint that looks something like 14/15. It may be a bit difficult to read but if you shine a light or use a magnifying glass on it; this may make it easier.
                             </p>
                             <p>
                            I would be happy to send you a replacement unit if you can provide us with a full mailing address.
                            </p>
                            <p>
                            Please click the following link to fill in your contact information.
                            </p>
                            <p>
                            <a href="{{ url('/') }}/feedback/edit/{{ $feedback->id }}/{{ $feedback->hash }}">
                                [Click Here to enter the lot code and your address.]
                            </a>
                            </p>
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