@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Email Templates</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ul>
            @foreach($emailLinks as $emailLink)
                <li> <a href="#" onclick="window.open( '{{ url('/') . '/admins/emails/'. $emailLink['scope'] . '/' . $emailLink['type'] }}', 'name', 'location=no,scrollbars=yes,status=no,toolbar=yes,resizable=yes' )">{{ $emailLink['title'] }}</a></li>
            @endforeach
            </ul>
        </div>
    </div>
    </div>

<div class="flash">
    Updated...
</div>

@stop




