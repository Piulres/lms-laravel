@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.datatrails.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h4>@lang('global.datatrails.title')</h4>
    </div>

    <div class="card">

        <div class="card-content">
            <div class="title col-12">
                <h5>@lang('global.app_view')</h5>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table class="striped">
                        <tr>
                            <th>@lang('global.datatrails.fields.trail')</th>
                            <td field-key='trail'>{{ $datatrail->trail->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrails.fields.user')</th>
                            <td field-key='user'>{{ $datatrail->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrails.fields.view')</th>
                            <td field-key='view'>{{ Form::checkbox("view", 1, $datatrail->view == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrails.fields.progress')</th>
                            <td field-key='progress'>{{ $datatrail->progress }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.datatrails.fields.rating')</th>
                            <td field-key='rating'>{{ $datatrail->rating }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


