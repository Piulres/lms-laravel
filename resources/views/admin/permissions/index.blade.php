@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m8"><h1>@lang('global.permissions.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.permissions.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m4 right-align">

                @can('permission_create')
                    <a href="{{ route('admin.permissions.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add Permission
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            @lang('global.app_list')
        </div>

        <div class="content">
            <table class="table table-striped no-order dataTable {{ count($permissions) > 0 ? 'datatable' : '' }} @can('permission_delete') dt-select @else dt-show @endcan">
                <thead>
                    <tr>
                        <th class="order-null"></th>
                        @can('permission_delete')
                            <th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>
                        @endcan

                        <th>@lang('global.permissions.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($permissions) > 0)
                        @foreach ($permissions as $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <td class="order-null"></td>
                                @can('permission_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $permission->title }}</td>
                                <td>
                                    <div class="buttons">
                                        @can('permission_view')
                                        <a href="{{ route('admin.permissions.show',[$permission->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('permission_edit')
                                        <a href="{{ route('admin.permissions.edit',[$permission->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('permission_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.permissions.destroy', $permission->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('permission_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.permissions.mass_destroy') }}';
        @endcan

    </script>
@endsection