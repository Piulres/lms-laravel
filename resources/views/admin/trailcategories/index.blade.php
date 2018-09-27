@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.trailcategories.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.trailcategories.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">

                @can('trailcategory_create')
                    <a href="{{ route('admin.trailcategories.create') }}" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle">
                        Add Category
                    </a>
                @endcan
            </div>
        </div>
    </div>
    
    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.trailcategories.index') }}" class="grey-text {{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.trailcategories.index') }}?show_deleted=1" class="grey-text {{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>

    <div class="card">
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="content">
            <table class="no-order striped responsive-table ajaxTable @can('trailcategory_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <th>@lang('global.app_order')</th>
                        @can('trailcategory_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.trailcategories.fields.title')</th>
                        <th>@lang('global.trailcategories.fields.slug')</th>
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
        @can('trailcategory_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.trailcategories.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.trailcategories.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [
                {data: 'title', name: 'title'},
                @can('trailcategory_delete')
                    @if ( request('show_deleted') != 1 )
                        {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                    @endif
                @endcan
                {data: 'title', name: 'title'},
                {data: 'slug', name: 'slug'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection