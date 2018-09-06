@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.internal-notifications.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.internal-notifications.fields.text')</th>
                            <td field-key='text'>{{ $internal_notification->text }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.internal-notifications.fields.link')</th>
                            <td field-key='link'>{{ $internal_notification->link }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.internal-notifications.fields.users')</th>
                            <td field-key='users'>
                                @foreach ($internal_notification->users as $singleUsers)
                                    <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.internal_notifications.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


