@extends('layouts.app')

@section('content')

    <div class="header-title col-12">
        <h4>@yield('title')</h4>
    </div>

    <div class="row" style="margin-top:15px;">

        {{--Sidebar--}}
        <div class="col-3">
            <a href="{{ route('admin.messenger.create') }}" class="waves-effect waves-light btn-large grey" style="width: 100%;">New message</a>

            <div class="collection" style="margin-top:8px;">
                <a href="{{ route('admin.messenger.index') }}" class="collection-item">All Messages</a>
                @php($unread = App\MessengerTopic::unreadInboxCount())
                <a href="{{ route('admin.messenger.inbox') }}" class="collection-item {{ ($unread > 0 ? 'unread' : '') }}">
                    Inbox
                    {{ ($unread > 0 ? '('.$unread.')' : '') }}
                </a>
                <a href="{{ route('admin.messenger.outbox') }}" class="collection-item">Outbox</a>
            </div>
        </div>


        {{--Main content--}}
        <div class="col-9">
            @yield('messenger-content')
        </div>
    </div>

@stop
