@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.datalesson.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.datalessons.index') }}">
                            @lang('global.datalesson.title')</a>
                    </li> /
                    <li><span>{{ $datalesson->view }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.datalessons.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                <div class="col m6 s12">
                    <table class="bordered striped">
                        <tr>
                            <th>@lang('global.datalesson.fields.view')</th>
                            <td field-key='view'>{{ $datalesson->view }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datalesson.fields.progress')</th>
                            <td field-key='progress'>{{ $datalesson->progress }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datalesson.fields.user')</th>
                            <td field-key='user'>{{ $datalesson->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datalesson.fields.course')</th>
                            <td field-key='course'>{{ $datalesson->course->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datalesson.fields.lesson')</th>
                            <td field-key='lesson'>{{ $datalesson->lesson->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


