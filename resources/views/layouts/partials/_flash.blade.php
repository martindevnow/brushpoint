

@if (Session::has('flash_notification'))
<?php $flash = Session::get('flash_notification'); ?>
    @if (!empty($flash) )
        @if (Session::has('flash_notification.overlay'))
            @include('layouts.partials._modal', ['modalClass' => 'flash-modal', 'title' => 'Notice', 'body' => Session::get('flash_notification.message')])
        @else
            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4 style="margin-bottom: 0px;">{{ Session::get('flash_notification.message') }}</h4>
            </div>
        @endif
    @endif
@endif