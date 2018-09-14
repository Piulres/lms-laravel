@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.internal_notifications.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h4>@lang('global.internal-notifications.title')</h4>
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
        </div>
    </div>
@stop


