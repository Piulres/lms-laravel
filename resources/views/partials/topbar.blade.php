<header class="main-header">
    <div class="navbar-fixed">
        <nav class="grey">
            <div class="container-fluid">
                <div class="nav-wrapper">
                    <a href="{{ url('/') }}" class="brand-logo grey">@lang('global.global_title')</span></a>
                    <ul class="right hide-on-med-and-down">
                        <li class="dropdown languages-menu">
                            <a class="dropdown-button" href="#!" data-target="dropdown-language">
                                {{ strtoupper(\App::getLocale()) }}
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"></li>
                                <ul id='dropdown-language' class='dropdown-content'>
                                    @foreach(config('app.languages') as $short => $title)
                                        <li class="language-link">
                                            <a href="{{ route('admin.language', $short) }}">
                                                {{ $title }} ({{ strtoupper($short) }})
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <li class="footer"></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropdown-button" href="#!" data-target="dropdown-notifications"><i class="material-icons">notifications</i></a>
                            <ul id='dropdown-notifications' class='dropdown-content'>
                                @if (count($notifications = \Auth::user()->internalNotifications()->get()) > 0)
                                    @foreach($notifications as $notification)
                                        <li class="notification-link {{ $notification->pivot->read_at === null ? "unread" : false }}">
                                            <a href="{{ $notification->link ? $notification->link : "#" }}"
                                               class="{{ $notification->link ? 'is-link' : false }}">
                                                {{ $notification->text }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="notification-link" style="text-align:center;">
                                        No notifications
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>


<style>
    .slimScrollDiv {
        width: auto !important;
        height:auto !important;
    }

    .notification-menu {
        width: auto !important;
        list-style-type: none;
        padding: 5px;
        max-width: 300px;
        height:auto !important;
    }

    .notification-link {
        width: auto;
    }

    .notification-link a {
        white-space: normal !important;
    }

    .unread a {
        font-weight: bold !important;
    }

    .is-link {
        color: #5b9bd1 !important;
    }
</style><style>
    .slimScrollDiv {
        width: auto !important;
        height:auto !important;
    }

    .language-menu {
        width: auto !important;
        list-style-type: none;
        padding: 0;
        margin: 0;
        max-width: 300px;
        height:auto !important;
        max-height: 500px !important;
    }

    .language-link {
        width: auto;
    }

    .language-link a {
        display: block;
        width: 100%;
        white-space: normal !important;
        padding: 5px;
    }
    .language-link a:hover {
        color: #389ad2;
        background: #f9f9f9;
    }
</style>

