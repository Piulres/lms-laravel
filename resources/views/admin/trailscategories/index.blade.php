@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>
            @lang('global.trailscategories.title')
        </h4>
        @can('trailscategory_create')
            <a href="{{ route('admin.trailscategories.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>

    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.trailscategories.index') }}" class="grey-text {{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.trailscategories.index') }}?show_deleted=1" class="grey-text {{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>

    <div class="card">

        <div class="card-content">
            <div class="title">
                <h5>@lang('global.app_list')</h5>
            </div>
            <table class="striped ajaxTable responsive-table @can('trailscategory_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('trailscategory_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.trailscategories.fields.title')</th>
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
        @can('trailscategory_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.trailscategories.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.trailscategories.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('trailscategory_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'title', name: 'title'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection