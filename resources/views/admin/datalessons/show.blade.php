@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.datalessons.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.datalesson.title')</h2>
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


