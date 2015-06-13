@extends('layouts.admin')


@section('content')

<div class="container">
    <div class="row">
        <table class="table form-table">
        <thead>
        <tr>
        <th>Field</th>
        <th>Value</th>
        </tr>
        </thead>
        <tbody>
        {!! Form::open(['method' => 'post', 'url' => '/admins/feedback/contact/send']) !!}
            <tr>
                <td>{!! Form::label('subject', 'Subject:') !!}</td>
                <td><!-- Title Form Input -->
                <div class="form-group">
                    {!! Form::text('subject', $subject, ['class' => 'form-control']) !!}
                </div>
                </td>
            </tr>
            <tr>
                <td>{!! Form::label('title', 'Title:') !!}</td>
                <td><!-- Title Form Input -->
                <div class="form-group">
                    {!! Form::text('title', $title, ['class' => 'form-control']) !!}
                </div>
                </td>
            </tr>
            <tr>
                <td>{!! Form::label('from_email', 'From:') !!}</td>
                <td><!-- Title Form Input -->
                <div class="form-group">
                    {!! Form::text('from_email', $from_email, ['class' => 'form-control']) !!}
                </div>
                </td>
            </tr>
            <tr>
                <td>{!! Form::label('to_email', 'To:') !!}</td>
                <td><!-- Title Form Input -->
                <div class="form-group">
                    {!! Form::text('to_email', $to_email, ['class' => 'form-control']) !!}
                </div>
                </td>
            </tr>
            <tr>
                <td>{!! Form::label('email_body', 'Email Body:') !!}</td>
                <td><!-- Title Form Input -->
                <div class="form-group">
                    {!! Form::textarea('email_body', $email_body, ['class' => 'form-control']) !!}
                </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><!-- Title Form Input -->
                <div class="form-group">
                    {!! Form::hidden('feedback_id', $feedback_id, ['class' => 'form-control']) !!}
                    {!! Form::hidden('customer_request_id', $customer_request_id, ['class' => 'form-control']) !!}
                    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                </div>
                </td>
            </tr>
        {!! Form::close() !!}
        </tbody>
        </table>
    </div>
</div>

<div class="flash">
    Updated...
</div>
@stop