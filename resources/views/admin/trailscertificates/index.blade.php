@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h2>@lang('global.trailscertificates.title')</h2>
        @can('trailscertificate_create')
            <a href="{{ route('admin.trailscertificates.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        @endcan
    </div>

    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.trailscertificates.index') }}" class="grey-text {{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.trailscertificates.index') }}?show_deleted=1" class="grey-text {{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>
    

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="card-content">
            <table class="striped responsive-table ajaxTable @can('trailscertificate_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <th>@lang('global.trailscertificates.fields.order')</th>
                        @can('trailscertificate_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan
                        <th>@lang('global.trailscertificates.fields.title')</th>
                        <th>@lang('global.trailscertificates.fields.slug')</th>
                        <th>@lang('global.trailscertificates.fields.image')</th>
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
        @can('trailscertificate_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.trailscertificates.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.trailscertificates.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [
            @can('trailscertificate_delete')
                {data: 'order', name: 'order'},
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan
                {data: 'title', name: 'title'},
                {data: 'slug', name: 'slug'},
                {data: 'image', name: 'image'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection