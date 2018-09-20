@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h2>@lang('global.general.title')</h2>
        @can('general_create')
            <a href="{{ route('admin.generals.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>

    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.generals.index') }}" class="grey-text {{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.generals.index') }}?show_deleted=1" class="grey-text {{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="card-content">
            <table class="no-order striped responsive-table ajaxTable @can('general_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <th class="order-null"></th>
                        @can('general_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.general.fields.site-name')</th>
                        <th>@lang('global.general.fields.site-logo')</th>
                        <th>@lang('global.general.fields.theme-color')</th>
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
        @can('general_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.generals.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.generals.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [
                {data: 'site_logo', name: 'site_logo'},
                @can('general_delete')
                    @if ( request('show_deleted') != 1 )
                        {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                    @endif
                @endcan{data: 'site_name', name: 'site_name'},
                {data: 'site_logo', name: 'site_logo'},
                {data: 'theme_color', name: 'theme_color'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection