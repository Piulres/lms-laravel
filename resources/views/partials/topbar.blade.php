<nav class="navbar-top navbar-under navbar-light">
    <div class="nav-wrapper">
        <a href="#" class="yay-toggle btn-toggle-menu">
            <div class="burg1"></div>
            <div class="burg2"></div>
            <div class="burg3"></div>
        </a>
        <a href="#!" class="brand-logo">
            @if($generals->count() >= 1)
                <img src="{{url('/')}}/{{$generals[0]->site_logo}}" alt="Con">
            @else
                <img src="{{ url('images') }}/Logo_RPX.png" alt="Con">
            @endif
        </a>
        <ul>
            <li class="dropdown languages-menu">
                <a class="dropdown-button" data-activates="dropdown-language" href="#!">
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
            {{--<li><a href="#!" class="search-bar-toggle"><i class="mdi-action-search"></i></a></li>--}}
            <li>
                <a class="dropdown-button" data-activates="dropdown-notifications" href="#!">
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
            @php($user = \Auth::user())
            <li class="user">
                <a class="dropdown-button user-top-infos" data-activates="user-dropdown" href="#!">
                @if($user->avatar)
                    <span class="avatar-icon" style="background-image: url('{{ url('/') }}/{{ $user->avatar }}'); "></span>
                @else
                    <img src="{{ url('/custom/avatar.png') }}" alt="{{$user->name . ' ' . $user->last_name}}" class="circle">{{$user->name . ' ' . $user->last_name}} <i class="mdi-navigation-expand-more right"></i>
                @endif
                    {{$user->name . ' ' . $user->last_name}} <i class="mdi-navigation-expand-more right"></i>
                </a>
                    <ul id="user-dropdown" class="dropdown-content">
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messenger.index') }}">
                            <i class="fa fa-envelope"></i>
                            Messages

                            @php($notificationCount = \Auth::user()->internalNotifications()->where('read_at', null)->count())
                            @if($notificationCount > 0)
                                <span class="badge new">{{ $notificationCount }} new</span>
                        </span>
                            @endif

                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.generals.index') }}">
                            <i class="fa fa-cogs"></i>
                            Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#logout" onclick="$('#logout').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>