@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.datacourses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h4>@lang('global.datacourses.title')</h4>
    </div>

    <div class="card">

        <div class="card-content">
            <div class="title col-12">
                @lang('global.app_view')
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.datacourses.fields.course')</th>
                            <td field-key='course'>{{ $datacourse->course->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourses.fields.user')</th>
                            <td field-key='user'>{{ $datacourse->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourses.fields.view')</th>
                            <td field-key='view'>{{ Form::checkbox("view", 1, $datacourse->view == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourses.fields.progress')</th>
                            <td field-key='progress'>{{ $datacourse->progress }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datacourses.fields.rating')</th>
                            <td field-key='rating'>{{ $datacourse->rating }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


