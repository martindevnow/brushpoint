<?php
$headerData['pageTitle'] = 'BrushPoint Contact: ' .$contact->id;

$titleData['title'] = 'New Contact Received';
$titleData['subtitle'] = 'Contact ID#: <a href="'.url('/').'/admins/contacts/'.$contact->id .'">'. $contact->id.' [VIEW]</a>';
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
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">

                                <h2>Contact From: {{ $contact->name }}</h2>

                                <p>
                                    <a href="{{ url('/') }}/admins/contacts/{{ $contact->id }}">View it here.</a>
                                </p>

                                <table>
                                <tr>
                                    <td>Name: </td>
                                    <td>{{ $contact->name }}</td>
                                </tr>
                                <tr>
                                    <td>Date: </td>
                                    <td>{{ $contact->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <td>Message: </td>
                                    <td>{{ $contact->message }}</td>
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