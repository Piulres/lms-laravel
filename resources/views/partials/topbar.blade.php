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
                        <li class="user">
                            <a class="dropdown-button" data-activates="user-dropdown" href="#!">
                                <img src="assets/_con/images/user.jpg" alt="John Doe" class="circle"> John Doe <i class="mdi-navigation-expand-more right"></i>
                            </a>
                            <ul id="user-dropdown" class="dropdown-content">
                                <li>
                                    <a href="page-profile.html">
                                        <i class="fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="mail-inbox.html">
                                        <i class="fa fa-envelope"></i> Messages <span class="badge new">2 new</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        <i class="fa fa-cogs"></i>
                                        Settings</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="page-sign-in.html">
                                        <i class="fa fa-sign-out"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>