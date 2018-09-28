@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.datacourse.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.datacourses.index') }}">
                            @lang('global.datacourse.title')</a>
                    </li> /
                    <li><span>{{ $datacourse->view }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.datacourses.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                            <th>@lang('global.datacourse.fields.view')</th>
                            <td field-key='view'>{{ $datacourse->view }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourse.fields.progress')</th>
                            <td field-key='progress'>{{ $datacourse->progress }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourse.fields.rating')</th>
                            <td field-key='rating'>{{ $datacourse->rating }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourse.fields.testimonal')</th>
                            <td field-key='testimonal'>{!! $datacourse->testimonal !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourse.fields.user')</th>
                            <td field-key='user'>{{ $datacourse->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourse.fields.course')</th>
                            <td field-key='course'>{{ $datacourse->course->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourse.fields.certificate')</th>
                            <td field-key='certificate'>{{ $datacourse->certificate->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


