@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.permissions.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h4>@lang('global.permissions.title')</h4>
    </div>

    <div class="card">

        <div class="card-content">
            <div class="card-title">
                <h5>@lang('global.app_view')</h5>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.permissions.fields.title')</th>
                            <td field-key='title'>{{ $permission->title }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#roles">Roles</a></li>
            </ul>
        </div>
        <div class="card-content">
            <div class="active" id="roles">
                <table class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>@lang('global.roles.fields.title')</th>
                                        <th>@lang('global.roles.fields.permission')</th>
                                                                <th>&nbsp;</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if (count($roles) > 0)
                            @foreach ($roles as $role)
                                <tr data-entry-id="{{ $role->id }}">
                                    <td field-key='title'>{{ $role->title }}</td>
                                        <td field-key='permission'>
                                            @foreach ($role->permission as $singlePermission)
                                                <span class="label label-info label-many">{{ $singlePermission->title }}</span>
                                            @endforeach
                                        </td>
                                        <td class="actions">
                                            <div class="buttons d-flex justify-content-end">
                                                @can('role_view')
                                                <a href="{{ route('admin.roles.show',[$role->id]) }}" class="waves-effect waves-light btn-small btn-square amber"><i class="material-icons">remove_red_eye</i></a>
                                                @endcan
                                                @can('role_edit')
                                                <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                                @endcan
                                                @can('role_delete')
                                                {!! Form::open(array(
                                                    'style' => 'display: inline-block;',
                                                    'method' => 'DELETE',
                                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                    'route' => ['admin.roles.destroy', $role->id])) !!}
                                                {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                                {!! Form::close() !!}
                                                @endcan
                                            </div>
                                        </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


