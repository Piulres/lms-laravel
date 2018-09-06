@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.datacourses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.datacourses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


