@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.users.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.users.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">

                @can('user_create')
                    <a href="{{ route('admin.users.create') }}" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle">
                        Add User
                    </a>
                @endcan
            </div>
        </div>
    </div>

   <div class="card paper-shadow">
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>
        <div class="content">

            <table class="no-order responsive-table striped ajaxTable @can('user_delete') dt-select @endcan">
                <thead>
                    <tr>
                        <th>@lang('global.app_order')</th>
                        @can('user_delete')
                            <th style="text-align:center;" class="select-all"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('global.users.fields.name')</th>
                        <th>@lang('global.users.fields.lastname')</th>
                        <th>@lang('global.users.fields.website')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.users.fields.avatar')</th>
                        <th>@lang('global.users.fields.role')</th>
                        <th>@lang('global.users.fields.team')</th>
                        <th>@lang('global.users.fields.approved')</th>
                        <th>@lang('global.app_actions')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('user_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.users.index') !!}';
            window.dtDefaultOptions.columns = [
                {data: 'name', name: 'name'},
                @can('user_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan
                {data: 'name', name: 'name'},
                {data: 'lastname', name: 'lastname'},
                {data: 'website', name: 'website'},
                {data: 'email', name: 'email'},
                {data: 'avatar', name: 'avatar'},
                {data: 'role.title', name: 'role.title'},
                {data: 'team.name', name: 'team.name'},
                {data: 'approved', name: 'approved'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection