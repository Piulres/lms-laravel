@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.datatrail.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.datatrails.index') }}">
                            @lang('global.datatrail.title')</a>
                    </li> /
                    <li><span>{{ $datatrail->view }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.datatrails.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                            <th>@lang('global.datatrail.fields.view')</th>
                            <td field-key='view'>{{ $datatrail->view }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrail.fields.progress')</th>
                            <td field-key='progress'>{{ $datatrail->progress }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrail.fields.rating')</th>
                            <td field-key='rating'>{{ $datatrail->rating }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrail.fields.testimonal')</th>
                            <td field-key='testimonal'>{!! $datatrail->testimonal !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrail.fields.user')</th>
                            <td field-key='user'>{{ $datatrail->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrail.fields.trail')</th>
                            <td field-key='trail'>{{ $datatrail->trail->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrail.fields.certificate')</th>
                            <td field-key='certificate'>{{ $datatrail->certificate->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


