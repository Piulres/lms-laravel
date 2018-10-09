@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.permissions.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            @lang('global.permissions.title')</a>
                    </li> /
                    <li><span>{{ $permission->title }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.permissions.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h5>@lang('global.app_view')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col s6">
                    <table class="table table-striped">
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
                <li class="tab grey-text"><a class="grey-text" href="#roles" aria-controls="roles">Roles</a></li>
            </ul>
        </div>

        <div class="content">
            
            <div role="tabpanel" class="tab-pane active" id="roles">
                <table class="striped responsive-table {{ count($roles) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th class="order-null"></th>
                            <th>@lang('global.roles.fields.title')</th>
                            <th>@lang('global.roles.fields.permission')</th>
                            <th>&nbsp;</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if (count($roles) > 0)
                            @foreach ($roles as $role)
                                <tr data-entry-id="{{ $role->id }}">
                                    <td class="order-null"></td>
                                    <td field-key='title'>{{ $role->title }}</td>
                                    <td field-key='permission'>
                                        @foreach ($role->permission as $singlePermission)
                                            <span class="label label-info label-many">{{ $singlePermission->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="buttons">
                                            @can('role_view')
                                            <a href="{{ route('admin.roles.show',[$role->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('role_edit')
                                            <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('role_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.roles.destroy', $role->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
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


