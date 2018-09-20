@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.datacourses.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.datacourse.title')</h2>
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


