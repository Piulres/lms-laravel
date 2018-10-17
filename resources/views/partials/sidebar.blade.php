@inject('request', 'Illuminate\Http\Request')
<aside class="yaybar yay-gestures yay-light yay-hide-to-small yay-shrink" id="sidebar-menu">
    <div class="top">
        <div>
           
           
                <a href="#" class="yay-toggle btn-toggle-menu">
                    <div class="burg1">
                    </div>
                    <div class="burg2"></div>
                    <div class="burg3"></div>
                </a>
           

            <!-- <a href="{{ URL::to('/') }}" class="brand-logo">
                <img src="{{ url('images') }}/Logo_RPX.png" alt="Con">
            </a> -->
            
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <ul class="collapsible collapsible-accordion">
                <li class="yay-user-info">
                    @php($user = \Auth::user())
                    <a href="#!">
                        @if($user->avatar)
                            <span class="avatar-icon" style="background-image: url('{{ url('/') }}/{{ $user->avatar }}'); "></span>
                        @else
                            <img src="{{ url('/custom/avatar.png') }}" alt="{{$user->name . ' ' . $user->last_name}} " class="circle">
                        @endif
                        <h3 class="yay-user-info-name">{{$user->name . ' ' . $user->last_name}} </h3>
                        <div class="yay-user-location">
                            <i class="fas fa-toolbox"></i>
                            @can('user_create')
                            Administrador
                                @else
                                Usuário
                            @endcan
                        </div>
                    </a>
                </li>
                <li class="label">Menu</li>
                <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                    <a href="{{ url('/admin/home') }}" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fas fa-tachometer-alt"></i>
                        @lang('global.app_dashboard')
                    </a>
                </li>

                @can('content_management_access')
                <li>
                    <a href="#" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fa fa-briefcase"></i>
                        @lang('global.content-management.title')
                        <span class="fas fa-plus yay-collapse-icon mdi-navigation-expand-more"></span>
                    </a>
                    <ul class="collapsible-body">
                        @can('content_category_access')
                        <li>
                            <a href="{{ route('admin.content_categories.index') }}">
                                <i class="fa fa-folder"></i>
                                <span>@lang('global.content-categories.title')</span>
                            </a>
                        </li>@endcan

                        @can('content_tag_access')
                        <li>
                            <a href="{{ route('admin.content_tags.index') }}">
                                <i class="fa fa-tags"></i>
                                <span>@lang('global.content-tags.title')</span>
                            </a>
                        </li>@endcan

                        @can('content_page_access')
                        <li>
                            <a href="{{ route('admin.content_pages.index') }}">
                                <i class="fas fa-file-alt"></i>
                                <span>@lang('global.content-pages.title')</span>
                            </a>
                        </li>@endcan
                    </ul>
                </li>@endcan

                @can('course_management_access')
                <li>
                    <a href="#" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fa fa-book"></i>
                        @lang('global.course-management.title')
                        <span class="fas fa-plus yay-collapse-icon mdi-navigation-expand-more"></span>
                    </a>
                    <ul class="collapsible-body">
                        @can('course_access')
                        <li>
                            <a href="{{ route('admin.courses.index') }}">
                                <i class="fa fa-list-ol"></i>
                                <span>@lang('global.courses.title')</span>
                            </a>
                        </li>@endcan

                        @can('lesson_access')
                        <li>
                            <a href="{{ route('admin.lessons.index') }}">
                                <i class="fas fa-list-alt"></i>
                                <span>@lang('global.lessons.title')</span>
                            </a>
                        </li>@endcan

                        @can('coursecategory_access')
                        <li>
                            <a href="{{ route('admin.coursecategories.index') }}">
                                <i class="fa fa-list"></i>
                                <span>@lang('global.coursecategories.title')</span>
                            </a>
                        </li>@endcan

                        @can('coursetag_access')
                        <li>
                            <a href="{{ route('admin.coursetags.index') }}">
                                <i class="fa fa-tags"></i>
                                <span>@lang('global.coursetags.title')</span>
                            </a>
                        </li>@endcan


                        @can('coursescertificate_access')
                        <li>
                            <a href="{{ route('admin.coursescertificates.index') }}">
                                <i class="fa fa-certificate"></i>
                                <span>@lang('global.coursescertificates.title')</span>
                            </a>
                        </li>@endcan
                    </ul>
                </li>@endcan

                @can('internal_notification_access')
                <li class="{{ $request->segment(1) == 'internal_notifications' ? 'active' : '' }}">
                    <a href="{{ route('admin.internal_notifications.index') }}" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fa fa-bell"></i>
                        <span>@lang('global.internal-notifications.title')</span>
                    </a>
                </li>@endcan

                @can('faq_management_access')
                <li>
                    <a href="#" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fa fa-question"></i>
                        @lang('global.faq-management.title')
                        <span class="fas fa-plus yay-collapse-icon mdi-navigation-expand-more"></span>
                    </a>
                    <ul class="collapsible-body">
                        @can('faq_category_access')
                        <li>
                            <a href="{{ route('admin.faq_categories.index') }}">
                                <i class="fa fa-briefcase"></i>
                                <span>@lang('global.faq-categories.title')</span>
                            </a>
                        </li>@endcan

                        @can('faq_question_access')
                        <li>
                            <a href="{{ route('admin.faq_questions.index') }}">
                                <i class="fa fa-question"></i>
                                <span>@lang('global.faq-questions.title')</span>
                            </a>
                        </li>@endcan
                    </ul>
                </li>@endcan

                @can('setting_access')
                <li>
                    <a href="#" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fas fa-cogs"></i>
                        @lang('global.settings.title')
                        <span class="fas fa-plus yay-collapse-icon mdi-navigation-expand-more"></span>
                    </a>
                    <ul class="collapsible-body">
                        @can('general_access')
                        <li>
                            <a href="{{ route('admin.generals.index') }}">
                                <i class="fas fa-cog"></i>
                                <span>@lang('global.general.title')</span>
                            </a>
                        </li>@endcan

                        @can('datatrail_access')
                        <li>
                            <a href="{{ route('admin.datatrails.index') }}">
                                <i class="fas fa-cog"></i>
                                <span>@lang('global.datatrail.title')</span>
                            </a>
                        </li>@endcan

                        @can('datacourse_access')
                        <li>
                            <a href="{{ route('admin.datacourses.index') }}">
                                <i class="fas fa-cog"></i>
                                <span>@lang('global.datacourse.title')</span>
                            </a>
                        </li>@endcan
                        @can('datalesson_access')
                        <li>
                            <a href="{{ route('admin.datalessons.index') }}">
                                <i class="fas fa-cog"></i>
                                <span>@lang('global.datalesson.title')</span>
                            </a>
                        </li>@endcan
                    </ul>
                </li>@endcan

                @can('trail_management_access')
                <li>
                    <a href="#" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fa fa-road"></i>
                        @lang('global.trail-management.title')
                        <span class="fas fa-plus yay-collapse-icon mdi-navigation-expand-more"></span>
                    </a>
                    <ul class="collapsible-body">
                        @can('trailcategory_access')
                        <li>
                            <a href="{{ route('admin.trailcategories.index') }}">
                                <i class="fas fa-list-ul"></i>
                                <span>@lang('global.trailcategories.title')</span>
                            </a>
                        </li>@endcan

                        @can('trailtag_access')
                        <li>
                            <a href="{{ route('admin.trailtags.index') }}">
                                <i class="fa fa-tags"></i>
                                <span>@lang('global.trailtags.title')</span>
                            </a>
                        </li>@endcan

                        @can('trail_access')
                        <li>
                            <a href="{{ route('admin.trails.index') }}">
                                <i class="fa fa-train"></i>
                                <span>@lang('global.trails.title')</span>
                            </a>
                        </li>@endcan

                        @can('trailscertificate_access')
                        <li>
                            <a href="{{ route('admin.trailscertificates.index') }}">
                                <i class="fa fa-certificate"></i>
                                <span>@lang('global.trailscertificates.title')</span>
                            </a>
                        </li>@endcan
                    </ul>
                </li>@endcan

                @can('user_management_access')
                <li>
                    <a href="#" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fa fa-users"></i>
                        @lang('global.user-management.title')
                        <span class="fas fa-plus yay-collapse-icon mdi-navigation-expand-more"></span>
                    </a>
                    <ul class="collapsible-body">
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

                        @can('user_access')
                        <li>
                            <a href="{{ route('admin.users.index') }}">
                                <i class="fa fa-user"></i>
                                <span>@lang('global.users.title')</span>
                            </a>
                        </li>@endcan

                        @can('team_access')
                        <li>
                            <a href="{{ route('admin.teams.index') }}">
                                <i class="fa fa-users"></i>
                                <span>@lang('global.teams.title')</span>
                            </a>
                        </li>@endcan

                        @can('user_action_access')
                        <li>
                            <a href="{{ route('admin.user_actions.index') }}">
                                <i class="fa fa-th-list"></i>
                                <span>@lang('global.user-actions.title')</span>
                            </a>
                        </li>@endcan
                    </ul>
                </li>@endcan





                @php ($unread = App\MessengerTopic::countUnread())
                <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                    <a href="{{ route('admin.messenger.index') }}" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fa fa-envelope"></i>

                        <span>Messages</span>
                        @if($unread > 0)
                            {{ ($unread > 0 ? '('.$unread.')' : '') }}
                        @endif
                    </a>
                </li>


                <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                    <a href="{{ route('auth.change_password') }}" class="collapsible-header yay-sub-toggle waves-effect ">
                        <i class="fa fa-key"></i>
                        @lang('global.app_change_password')
                    </a>
                </li>

                {{--<li>--}}
                    {{--<a href="#logout" onclick="$('#logout').submit();" class="collapsible-header yay-sub-toggle waves-effect ">--}}
                        {{--<i class="fa fa-arrow-left"></i>--}}
                        {{--@lang('global.app_logout')--}}
                    {{--</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</aside>


@if($request->segment(1) == 'home')
<div class="fixed-action-btn">
    <a class="btn-floating btn-large red">
        <i class="large mdi-editor-mode-edit"></i>
    </a>
    <ul>
        <li>
            <a class="btn-floating red">
                <i class="large mdi-av-my-library-books"></i>
            </a>
        </li>
        <li>
            <a class="btn-floating yellow darken-1">
                <i class="large mdi-av-playlist-add"></i>
            </a>
        </li>
    </ul>
</div>
@endif

