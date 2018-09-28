@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.general.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.general.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">

                @can('general_create')
                    <a href="{{ route('admin.generals.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add setting
                    </a>
                @endcan
            </div>
        </div>
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
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="content">
            <table class="table table-striped no-order ajaxTable @can('general_delete') @if ( request('show_deleted') != 1 ) dt-select @else dt-show     @endif @endcan">
                <thead>
                    <tr>
                        <th class="order-null"></th>
                        @can('general_delete')
                            @if ( request('show_deleted') != 1 )<th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>@endif
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
                {data: 'site_logo', name: 'site_name'},
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