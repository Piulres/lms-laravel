@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.datacourses.title')</h4>
        @can('datacourse_create')
            <a href="{{ route('admin.datacourses.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>

    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.datacourses.index') }}" class="grey-text {{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.datacourses.index') }}?show_deleted=1" class="grey-text {{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>

    <div class="card">

        <div class="card-content">
            <div class="title col-12">
                <h5>@lang('global.app_list')</h5>
            </div>
            <table class="striped responsive-table ajaxTable @can('datacourse_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <th></th>
                        @can('datacourse_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.datacourses.fields.course')</th>
                        <th>@lang('global.datacourses.fields.user')</th>
                        <th>@lang('global.datacourses.fields.view')</th>
                        <th>@lang('global.datacourses.fields.progress')</th>
                        <th>@lang('global.datacourses.fields.rating')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('datacourse_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.datacourses.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.datacourses.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('datacourse_delete')
                {data: 'course.title', name: 'course.title'},
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan
                {data: 'course.title', name: 'course.title'},
                {data: 'user.name', name: 'user.name'},
                {data: 'view', name: 'view'},
                {data: 'progress', name: 'progress'},
                {data: 'rating', name: 'rating'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection