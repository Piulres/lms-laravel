@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.datatrails.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.datatrail.title')</h2>
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


