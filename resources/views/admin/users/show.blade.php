@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.users.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            @lang('global.users.title')</a>
                    </li> /
                    <li><span>{{ $user->name }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.users.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="content">
            <div class="title col-12">
                <h5>@lang('global.app_view')</h5>
            </div>
            <div class="row">
                <div class="col s6">
                    <table class="striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.lastname')</th>
                            <td field-key='last_name'>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.website')</th>
                            <td field-key='website'>{{ $user->website }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.avatar')</th>
                            <td field-key='avatar'>@if($user->avatar)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->avatar) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.team')</th>
                            <td field-key='team'>{{ $user->team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
        </div>
    </div>

    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#user_actions">User actions</a></li>
                <li class="tab grey-text"><a class="grey-text" href="#datacourses">Data Courses</a></li>
                <li class="tab grey-text"><a class="grey-text" href="#datatrails">Data Trails</a></li>
                <li class="tab grey-text"><a class="grey-text" href="#courses">Courses</a></li>
                <li class="tab grey-text"><a class="grey-text" href="#internal_notifications">Notifications</a></li>
            </ul>
        </div>
        <div class="content">
            <div id="user_actions">
                <table class="striped responsive-table {{ count($user_actions) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>@lang('global.user-actions.created_at')</th>
                            <th>@lang('global.user-actions.fields.user')</th>
                            <th>@lang('global.user-actions.fields.action')</th>
                            <th>@lang('global.user-actions.fields.action-model')</th>
                            <th>@lang('global.user-actions.fields.action-id')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($user_actions) > 0)
                            @foreach ($user_actions as $user_action)
                                <tr data-entry-id="{{ $user_action->id }}">
                                    <td></td>
                                    <td></td>
                                    <td>{{ $user_action->created_at or '' }}</td>
                                    <td field-key='user'>{{ $user_action->user->name or '' }}</td>
                                    <td field-key='action'>{{ $user_action->action }}</td>
                                    <td field-key='action_model'>{{ $user_action->action_model }}</td>
                                    <td field-key='action_id'>{{ $user_action->action_id }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div id="datacourses">
                <table class="striped responsive-table {{ count($datacourses) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>@lang('global.datacourses.fields.course')</th>
                            <th>@lang('global.datacourses.fields.user')</th>
                            <th>@lang('global.datacourses.fields.view')</th>
                            <th>@lang('global.datacourses.fields.progress')</th>
                            <th>@lang('global.datacourses.fields.rating')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($datacourses) > 0)
                            @foreach ($datacourses as $datacourse)
                                <tr data-entry-id="{{ $datacourse->id }}">
                                    <td></td>
                                    <td></td>
                                    <td field-key='course'>{{ $datacourse->course->title or '' }}</td>
                                    <td field-key='user'>{{ $datacourse->user->name or '' }}</td>
                                    <td field-key='view'>{{ Form::checkbox("view", 1, $datacourse->view == 1 ? true : false, ["disabled"]) }}</td>
                                    <td field-key='progress'>{{ $datacourse->progress }}</td>
                                    <td field-key='rating'>{{ $datacourse->rating }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.datacourses.restore', $datacourse->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn-square blue-text')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.datacourses.perma_del', $datacourse->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn-square red-text')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    @else
                                    <td class="actions">
                                        <div class="buttons d-flex align-items-center justify-content-end">
                                            @can('datacourse_view')
                                            <a href="{{ route('admin.datacourses.show',[$datacourse->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('datacourse_edit')
                                            <a href="{{ route('admin.datacourses.edit',[$datacourse->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('datacourse_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.datacourses.destroy', $datacourse->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                            </div>
                                        </td>
                                        @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div id="datatrails">
                <table class="striped responsive-table {{ count($datatrails) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>@lang('global.datatrails.fields.trail')</th>
                            <th>@lang('global.datatrails.fields.user')</th>
                            <th>@lang('global.datatrails.fields.view')</th>
                            <th>@lang('global.datatrails.fields.progress')</th>
                            <th>@lang('global.datatrails.fields.rating')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($datatrails) > 0)
                            @foreach ($datatrails as $datatrail)
                                <tr data-entry-id="{{ $datatrail->id }}">
                                    <td></td>
                                    <td></td>
                                    <td field-key='trail'>{{ $datatrail->trail->title or '' }}</td>
                                    <td field-key='user'>{{ $datatrail->user->name or '' }}</td>
                                    <td field-key='view'>{{ Form::checkbox("view", 1, $datatrail->view == 1 ? true : false, ["disabled"]) }}</td>
                                    <td field-key='progress'>{{ $datatrail->progress }}</td>
                                    <td field-key='rating'>{{ $datatrail->rating }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.datatrails.restore', $datatrail->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn-square blue-text')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.datatrails.perma_del', $datatrail->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn-square red-text')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    @else
                                    <td class="actions">
                                        <div class="buttons d-flex align-items-center justify-content-end">
                                            @can('datatrail_view')
                                            <a href="{{ route('admin.datatrails.show',[$datatrail->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('datatrail_edit')
                                            <a href="{{ route('admin.datatrails.edit',[$datatrail->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('datatrail_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.datatrails.destroy', $datatrail->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div id="courses">
                <table class="striped responsive-table {{ count($courses) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>@lang('global.courses.fields.title')</th>
                            <th>@lang('global.courses.fields.instructor')</th>
                            <th>@lang('global.courses.fields.lessons')</th>
                            <th>@lang('global.courses.fields.categories')</th>
                            <th>@lang('global.courses.fields.featured-image')</th>
                            <th>@lang('global.courses.fields.description')</th>
                            <th>@lang('global.courses.fields.introduction')</th>
                            <th>@lang('global.courses.fields.duration')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($courses) > 0)
                            @foreach ($courses as $course)
                                <tr data-entry-id="{{ $course->id }}">
                                    <td></td>
                                    <td></td>
                                    <td field-key='title'>{{ $course->title }}</td>
                                    <td field-key='instructor'>
                                        @foreach ($course->instructor as $singleInstructor)
                                            <span class="label label-info label-many">{{ $singleInstructor->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='lessons'>
                                        @foreach ($course->lessons as $singleLessons)
                                            <span class="label label-info label-many">{{ $singleLessons->title }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='categories'>
                                        @foreach ($course->categories as $singleCategories)
                                            <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='featured_image'>@if($course->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $course->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->featured_image) }}"/></a>@endif</td>
                                    <td field-key='description'>{!! $course->description !!}</td>
                                    <td field-key='introduction'>{!! $course->introduction !!}</td>
                                    <td field-key='duration'>{{ $course->duration }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.courses.restore', $course->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn-square blue-text')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.courses.perma_del', $course->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn-square red-text')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td class="actions">
                                        <div class="buttons d-flex align-items-center justify-content-end">
                                            @can('course_view')
                                            <a href="{{ route('admin.courses.show',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('course_edit')
                                            <a href="{{ route('admin.courses.edit',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('course_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.courses.destroy', $course->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="13">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div id="internal_notifications">
                <table class="striped responsive-table {{ count($internal_notifications) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <tr></tr>
                            <tr></tr>
                            <th>@lang('global.internal-notifications.fields.text')</th>
                            <th>@lang('global.internal-notifications.fields.link')</th>
                            <th>@lang('global.internal-notifications.fields.users')</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($internal_notifications) > 0)
                            @foreach ($internal_notifications as $internal_notification)
                                <tr data-entry-id="{{ $internal_notification->id }}">
                                    <td></td>
                                    <td></td>
                                    <td field-key='text'>{{ $internal_notification->text }}</td>
                                    <td field-key='link'>{{ $internal_notification->link }}</td>
                                    <td field-key='users'>
                                        @foreach ($internal_notification->users as $singleUsers)
                                            <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="actions">
                                        <div class="buttons d-flex align-items-center justify-content-end">
                                            @can('internal_notification_view')
                                            <a href="{{ route('admin.internal_notifications.show',[$internal_notification->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('internal_notification_edit')
                                            <a href="{{ route('admin.internal_notifications.edit',[$internal_notification->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('internal_notification_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.internal_notifications.destroy', $internal_notification->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


