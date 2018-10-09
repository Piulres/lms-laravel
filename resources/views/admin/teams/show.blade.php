@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.roles.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.teams.index') }}">
                            @lang('global.roles.title')</a>
                    </li> /
                    <li><span>{{ $team->name }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.roles.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h5>@lang('global.app_view')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col s6">
                    <table class="striped">
                        <tr>
                            <th>@lang('global.teams.fields.name')</th>
                            <td field-key='name'>{{ $team->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#users">Users</a></li>
            </ul>
        </div>
        <div class="content">
    
            <div role="tabpanel" class="tab-pane active" id="users">
                <table class="striped responsive-table {{ count($users) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <th>@lang('global.users.fields.lastname')</th>
                            <th>@lang('global.users.fields.website')</th>
                            <th>@lang('global.users.fields.email')</th>
                            <th>@lang('global.users.fields.avatar')</th>
                            <th>@lang('global.users.fields.role')</th>
                            <th>@lang('global.users.fields.team')</th>
                            <th>@lang('global.users.fields.approved')</th>
                            <th>&nbsp;</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr data-entry-id="{{ $user->id }}">
                                    <td field-key='name'>{{ $user->name }}</td>
                                    <td field-key='lastname'>{{ $user->lastname }}</td>
                                    <td field-key='website'>{{ $user->website }}</td>
                                    <td field-key='email'>{{ $user->email }}</td>
                                    <td field-key='avatar'>@if($user->avatar)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->avatar) }}"/></a>@endif</td>
                                    <td field-key='role'>
                                        @foreach ($user->role as $singleRole)
                                            <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='team'>{{ $user->team->name or '' }}</td>
                                    <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                                    <td>
                                        <div class="buttons">
                                            @can('user_view')
                                            <a href="{{ route('admin.users.show',[$user->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('user_edit')
                                            <a href="{{ route('admin.users.edit',[$user->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('user_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.users.destroy', $user->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="15">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


