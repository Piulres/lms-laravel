@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h2>@lang('global.trails.title')</h2>
        @can('trailtag_create')
            <a href="{{ route('admin.trails.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>
    
    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.trails.index') }}" class="grey-text {{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.trails.index') }}?show_deleted=1" class="grey-text {{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="card-content">
            <table class="striped responsive-table ajaxTable @can('trail_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <th>@lang('global.trails.fields.order')</th>

                        @can('trail_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.trails.fields.title')</th>
                        <th>@lang('global.trails.fields.slug')</th>
                        <th>@lang('global.trails.fields.description')</th>
                        <th>@lang('global.trails.fields.introduction')</th>
                        <th>@lang('global.trails.fields.featured-image')</th>
                        <th>@lang('global.trails.fields.courses')</th>
                        <th>@lang('global.trails.fields.start-date')</th>
                        <th>@lang('global.trails.fields.end-date')</th>
                        <th>@lang('global.trails.fields.categories')</th>
                        <th>@lang('global.trails.fields.tags')</th>
                        <th>@lang('global.trails.fields.approved')</th>
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
        @can('trail_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.trails.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.trails.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('trail_delete')
                {data: 'order', name: 'order'},
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan
                {data: 'title', name: 'title'},
                {data: 'slug', name: 'slug'},
                {data: 'description', name: 'description'},
                {data: 'introduction', name: 'introduction'},
                {data: 'featured_image', name: 'featured_image'},
                {data: 'courses.title', name: 'courses.title'},
                {data: 'start_date', name: 'start_date'},
                {data: 'end_date', name: 'end_date'},
                {data: 'categories.title', name: 'categories.title'},
                {data: 'tags.title', name: 'tags.title'},
                {data: 'approved', name: 'approved'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection