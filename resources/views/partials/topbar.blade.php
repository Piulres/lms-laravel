<header class="main-header">
    <div class="navbar-fixed">
        <nav class="grey lighten-5 z-depth-0 border-bottom">
            <div class="container-fluid">
                <div class="nav-wrapper">
                    <a href="{{ url('/') }}" class="brand-logo left cyan"><span>@lang('global.global_title')</span></a>
                    <ul class="right">
                        <li class="dropdown languages-menu">
                            <a class="dropdown-button grey-text" href="#!" data-target="dropdown-language">
                                {{ strtoupper(\App::getLocale()) }}
                            </a>
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
                        </li>
                        <li>
                            <a class="dropdown-button grey-text" href="#!" data-target="dropdown-notifications">
                                <i class="far fa-bell"></i>
                                @php($notificationCount = \Auth::user()->internalNotifications()->where('read_at', null)->count())
                                @if($notificationCount > 0)
                                    <span class="new badge sup" data-badge-caption="">
                                        {{ $notificationCount }}
                                    </span>
                                @endif
                            </a>
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
                        <li class="hide-on-lar-and-up">
                            <a href="#" data-target="sidebar-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>