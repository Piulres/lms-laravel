@inject('request', 'Illuminate\Http\Request')
<aside class="sidenav sidenav-fixed" id="sidebar-menu">
    <ul>
        <li class="input-field col s6">
            <i class="material-icons prefix">search</i>
            <input placeholder="Search" id="first_name" type="text" class="validate">
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">

                <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                    <a href="{{ url('/admin/home') }}" class="collapsible-header">
                        <i class="material-icons prefix">dashboard</i>
                        <span class="title">@lang('global.app_dashboard')</span>
                    </a>
                </li>

                @can('user_management_access')
                <li>
                    <a class="collapsible-header">
                        <i class="fa fa-users"></i>
                        <span>@lang('global.user-management.title')</span>
                        <i class="material-icons right">keyboard_arrow_down</i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            @can('user_access')
                            <li>
                                <a href="{{ route('admin.users.index') }}">
                                    <i class="fa fa-user"></i>
                                    <span>@lang('global.users.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('permission_access')
                            <li>
                                <a href="{{ route('admin.permissions.index') }}">
                                    <i class="fa fa-briefcase"></i>
                                    <span>@lang('global.permissions.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('role_access')
                            <li>
                                <a href="{{ route('admin.roles.index') }}">
                                    <i class="fa fa-briefcase"></i>
                                    <span>@lang('global.roles.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('user_action_access')
                            <li>
                                <a href="{{ route('admin.user_actions.index') }}">
                                    <i class="fa fa-th-list"></i>
                                    <span>@lang('global.user-actions.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('team_access')
                            <li>
                                <a href="{{ route('admin.teams.index') }}">
                                    <i class="fa fa-users"></i>
                                    <span>@lang('global.teams.title')</span>
                                </a>
                            </li>@endcan
                        </ul>
                    </div>
                </li>@endcan

                @can('course_management_access')
                <li>
                    <a class="collapsible-header">
                        <i class="fa fa-book"></i>
                        <span>@lang('global.course-management.title')</span>
                        <i class="material-icons right">keyboard_arrow_down</i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            @can('course_access')
                            <li>
                                <a href="{{ route('admin.courses.index') }}">
                                    <i class="fa fa-list-alt"></i>
                                    <span>@lang('global.courses.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('coursescategory_access')
                            <li>
                                <a href="{{ route('admin.coursescategories.index') }}">
                                    <i class="fa fa-list-ol"></i>
                                    <span>@lang('global.coursescategories.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('lesson_access')
                            <li>
                                <a href="{{ route('admin.lessons.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.lessons.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </div>
                </li>@endcan

                @can('trail_management_access')
                <li>
                    <a class="collapsible-header">
                        <i class="fa fa-road"></i>
                        <span>@lang('global.trail-management.title')</span>
                        <i class="material-icons right">keyboard_arrow_down</i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            @can('trail_access')
                            <li>
                                <a href="{{ route('admin.trails.index') }}">
                                    <i class="fa fa-train"></i>
                                    <span>@lang('global.trails.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('trailscategory_access')
                            <li>
                                <a href="{{ route('admin.trailscategories.index') }}">
                                    <i class="fa fa-list-ol"></i>
                                    <span>@lang('global.trailscategories.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </div>
                </li>@endcan

                @can('setting_access')
                <li>
                    <a class="collapsible-header">
                        <i class="fa fa-gears"></i>
                        <span>@lang('global.settings.title')</span>
                        <i class="material-icons right">keyboard_arrow_down</i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            @can('datacourse_access')
                            <li>
                                <a href="{{ route('admin.datacourses.index') }}">
                                    <i class="fa fa-gear"></i>
                                    <span>@lang('global.datacourses.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('datatrail_access')
                            <li>
                                <a href="{{ route('admin.datatrails.index') }}">
                                    <i class="fa fa-gear"></i>
                                    <span>@lang('global.datatrails.title')</span>
                                </a>
                            </li>@endcan
                        </ul>
                    </div>
                </li>@endcan

                @can('internal_notification_access')
                <li>
                    <a href="{{ route('admin.internal_notifications.index') }}" class="collapsible-header">
                        <i class="fa fa-briefcase"></i>
                        <span>@lang('global.internal-notifications.title')</span>
                    </a>
                </li>@endcan

            
                @php ($unread = App\MessengerTopic::countUnread())
                <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                    <a href="{{ route('admin.messenger.index') }}" class="collapsible-header">
                        <i class="fa fa-envelope"></i>

                        <span>Messages</span>
                        @if($unread > 0)
                            {{ ($unread > 0 ? '('.$unread.')' : '') }}
                        @endif
                    </a>
                </li>
                <style>
                    .page-sidebar-menu .unread * {
                        font-weight:bold !important;
                    }
                </style>



                <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                    <a href="{{ route('auth.change_password') }}" class="collapsible-header">
                        <i class="fa fa-key"></i>
                        <span class="title">@lang('global.app_change_password')</span>
                    </a>
                </li>

                <li>
                    <a href="#logout" onclick="$('#logout').submit();" class="collapsible-header">
                        <i class="fa fa-arrow-left"></i>
                        <span class="title">@lang('global.app_logout')</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<!-- Left side column. contains the sidebar -->
{{-- <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>
            

            
            

            


        </ul>
    </section>
</aside>
 --}}
