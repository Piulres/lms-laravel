@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.internal-notifications.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.internal-notifications.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">

                @can('internal_notification_create')
                    <a href="{{ route('admin.internal_notifications.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add notify
                    </a>
                @endcan
            </div>
        </div>
    </div>

    
    <div class="card">
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="content">
            <table class="table table-striped {{ count($internal_notifications) > 0 ? 'datatable' : '' }} @can('internal_notification_delete') dt-select @else dt-show @endcan">
                <thead>
                    <tr>
                        <th class="order-null"></th>
                        @can('internal_notification_delete')
                            <th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>
                        @endcan
                        <th>@lang('global.internal-notifications.fields.text')</th>
                        <th>@lang('global.internal-notifications.fields.link')</th>
                        <th>@lang('global.internal-notifications.fields.users')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($internal_notifications) > 0)
                        @foreach ($internal_notifications as $internal_notification)
                            <tr data-entry-id="{{ $internal_notification->id }}">
                                <td class="order-null"></td>
                                @can('internal_notification_delete')
                                    <td></td>
                                @endcan
                                <td field-key='text'>{{ $internal_notification->text }}</td>
                                <td field-key='link'>{{ $internal_notification->link }}</td>
                                <td field-key='users'>
                                    @foreach ($internal_notification->users as $singleUsers)
                                        <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="buttons">
                                        @can('internal_notification_view')
                                        <a href="{{ route('admin.internal_notifications.show',[$internal_notification->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('internal_notification_edit')
                                        <a href="{{ route('admin.internal_notifications.edit',[$internal_notification->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('internal_notification_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.internal_notifications.destroy', $internal_notification->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('internal_notification_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.internal_notifications.mass_destroy') }}';
        @endcan

    </script>
@endsection