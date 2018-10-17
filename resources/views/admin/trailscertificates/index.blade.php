@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m8"><h1>@lang('global.trailscertificates.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.trailscertificates.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m4 right-align">

                @can('trailscertificate_create')
                    <a href="{{ route('admin.trailscertificates.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add Certificate
                    </a>
                @endcan
            </div>
        </div>
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
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="content">
            <table class="table table-striped ajaxTable @can('trailscertificate_delete') @if ( request('show_deleted') != 1 ) dt-select @else dt-show @endif @endcan">
                <thead>
                    <tr>
                        <th>@lang('global.trailscertificates.fields.order')</th>
                        @can('trailscertificate_delete')
                            @if ( request('show_deleted') != 1 )<th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>@endif
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