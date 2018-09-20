@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.generals.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.general.title')</h2>
    </div>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_view')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-md-6">
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
                            <td field-key='theme_color'>{{ $general->theme_color }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


