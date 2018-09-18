@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.general.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.generals.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


