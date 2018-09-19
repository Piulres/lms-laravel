@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h2>@lang('global.users.title')</h2>
        @can('user_create')
            <a href="{{ route('admin.users.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>

   <div class="card paper-shadow">
        <div class="card-title">
            <h5>@lang('global.app_list')</h5>
        </div>
        <div class="card-content">

            <table class="responsive-table striped ajaxTable @can('user_delete') dt-select @endcan">
                <thead>
                    <tr>
                        <th>@lang('global.app_order')</th>
                        @can('user_delete')
                            <th style="text-align:center;" class="select-all"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('global.users.fields.name')</th>
                        <th>@lang('global.users.fields.lastname')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.users.fields.website')</th>
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