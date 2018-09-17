@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>
            @lang('global.users.title')
            @can('user_create')
            <a href="{{ route('admin.users.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
            @endcan
        </h4>
    </div>

    

    <div class="card">
        <div class="card-content">
            <div class="title">
                <h5>@lang('global.app_list')</h5>
            </div>

            <div class="overflow-parent">
                <div class="overflow-child">
                    <table class="striped ajaxTable @can('user_delete') dt-select @endcan responsive-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                @can('user_delete')
                                    <th style="text-align:center;" id="select-all"><input type="checkbox" /></th>
                                @endcan
                                <th>@lang('global.users.fields.name')</th>
                                <th>@lang('global.users.fields.last-name')</th>
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
                {data: 'name', name: 'order'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'website', name: 'website'},
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