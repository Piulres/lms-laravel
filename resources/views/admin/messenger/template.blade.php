@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10">
                <h1>@yield('title')
                    <small class="grey-text">(
                        @php($unread = App\MessengerTopic::unreadInboxCount())
                        {{ ($unread > 0 ? '('.$unread.')' : '') }} new)</small>
                </h1>
                <ul>
                    <li><a href="#"><i class="fa fa-home"></i> Home</a> /</li>
                    <li><a href="mail-inbox.html">Inbox
                            <small class="grey-text">(
                                @php($unread = App\MessengerTopic::unreadInboxCount())
                                {{ ($unread > 0 ? '('.$unread.')' : '') }} new)</small>
                        </a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mail-inbox">

        {{--Sidebar--}}
        <div class="col s12 m3 l2">
            <div class="card-panel">
                <!-- Mail Sidebar -->
                <ul class="mail-sidebar">
                    <li>
                        <a href="{{ route('admin.messenger.index') }}">
                            <i class="mdi-content-mail"></i>
                            All Messages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messenger.index') }}">
                            <i class="mdi-content-inbox"></i>
                            Inbox
                            @php($unread = App\MessengerTopic::unreadInboxCount())
                            {{ ($unread > 0 ? '('.$unread.')' : '') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messenger.outbox') }}">
                            <i class="mdi-content-send"></i>
                            Outbox
                        </a>
                    </li>
                </ul><!-- /Mail Sidebar -->
            </div>
        </div>

        {{--Main content--}}
        <div class="col s12 m9 l10">
            @yield('messenger-content')
        </div>
    </div>
    <a class="mail-compose-btn btn-floating btn-extra waves-effect waves-light red tooltipped" href="{{ route('admin.messenger.create') }}" data-tooltip="Compose" data-position="left" data-tooltip-id="31c8df03-655a-ff50-36e8-fbd9370a593f">
        <i class="mdi-content-add"></i>
    </a>

@stop
