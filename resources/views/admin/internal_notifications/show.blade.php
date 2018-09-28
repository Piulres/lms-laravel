@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.internal-notifications.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.internal_notifications.index') }}">
                            @lang('global.internal-notifications.title')</a>
                    </li> /
                    <li><span>{{ $internal_notification->text }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.internal_notifications.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('global.internal-notifications.fields.text')</th>
                            <td field-key='text'>{{ $internal_notification->text }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.internal-notifications.fields.link')</th>
                            <td field-key='link'>{{ $internal_notification->link }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.internal-notifications.fields.users')</th>
                            <td field-key='users'>
                                @foreach ($internal_notification->users as $singleUsers)
                                    <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


