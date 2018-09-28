@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.general.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.generals.index') }}">
                            @lang('global.general.title')</a>
                    </li> /
                    <li><span>{{ $general->site_name }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.generals.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                    <table class="bordered striped">
                        <tr>
                            <th>@lang('global.general.fields.site-name')</th>
                            <td field-key='site_name'>{{ $general->site_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.general.fields.site-logo')</th>
                            <td field-key='site_logo'>@if($general->site_logo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $general->site_logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $general->site_logo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.general.fields.theme-color')</th>
                            <td field-key='theme_color'>
                                <div class="box-color {{ $general->theme_color }}"></div>
                                {{ $general->theme_color }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


