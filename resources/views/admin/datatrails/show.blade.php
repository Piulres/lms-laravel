@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.datatrail.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.datatrails.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


