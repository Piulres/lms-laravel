@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('content_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>@lang('global.content-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
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
                            <i class="fa fa-file-o"></i>
                            <span>@lang('global.content-pages.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('course_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>@lang('global.course-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('lesson_access')
                    <li>
                        <a href="{{ route('admin.lessons.index') }}">
                            <i class="fa fa-files-o"></i>
                            <span>@lang('global.lessons.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('coursecategory_access')
                    <li>
                        <a href="{{ route('admin.coursecategories.index') }}">
                            <i class="fa fa-list-ol"></i>
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
                    
                    @can('course_access')
                    <li>
                        <a href="{{ route('admin.courses.index') }}">
                            <i class="fa fa-list-alt"></i>
                            <span>@lang('global.courses.title')</span>
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
            <li>
                <a href="{{ route('admin.internal_notifications.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('global.internal-notifications.title')</span>
                </a>
            </li>@endcan
            
            @can('faq_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-question"></i>
                    <span>@lang('global.faq-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
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
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.settings.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('general_access')
                    <li>
                        <a href="{{ route('admin.generals.index') }}">
                            <i class="fa fa-gear"></i>
                            <span>@lang('global.general.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('coursesdatum_access')
                    <li>
                        <a href="{{ route('admin.coursesdatas.index') }}">
                            <i class="fa fa-gear"></i>
                            <span>@lang('global.coursesdata.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('traildatum_access')
                    <li>
                        <a href="{{ route('admin.traildatas.index') }}">
                            <i class="fa fa-gear"></i>
                            <span>@lang('global.traildata.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('trail_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-road"></i>
                    <span>@lang('global.trail-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('trailcategory_access')
                    <li>
                        <a href="{{ route('admin.trailcategories.index') }}">
                            <i class="fa fa-list-ol"></i>
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
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
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
                <a href="{{ route('admin.messenger.index') }}">
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
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

