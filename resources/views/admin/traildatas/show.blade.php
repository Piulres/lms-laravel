@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.traildata.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.traildata.fields.view')</th>
                            <td field-key='view'>{{ $traildata->view }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.traildata.fields.progress')</th>
                            <td field-key='progress'>{{ $traildata->progress }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.traildata.fields.rating')</th>
                            <td field-key='rating'>{{ $traildata->rating }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.traildata.fields.testimonal')</th>
                            <td field-key='testimonal'>{!! $traildata->testimonal !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.traildata.fields.user')</th>
                            <td field-key='user'>{{ $traildata->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.traildata.fields.trail')</th>
                            <td field-key='trail'>{{ $traildata->trail->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.traildata.fields.certificate')</th>
                            <td field-key='certificate'>{{ $traildata->certificate->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.traildatas.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


