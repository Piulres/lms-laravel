@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.coursesdata.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.coursesdata.fields.view')</th>
                            <td field-key='view'>{{ $coursesdata->view }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursesdata.fields.progress')</th>
                            <td field-key='progress'>{{ $coursesdata->progress }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursesdata.fields.rating')</th>
                            <td field-key='rating'>{{ $coursesdata->rating }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursesdata.fields.testimonal')</th>
                            <td field-key='testimonal'>{!! $coursesdata->testimonal !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursesdata.fields.user')</th>
                            <td field-key='user'>{{ $coursesdata->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursesdata.fields.course')</th>
                            <td field-key='course'>{{ $coursesdata->course->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursesdata.fields.certificate')</th>
                            <td field-key='certificate'>{{ $coursesdata->certificate->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.coursesdatas.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


