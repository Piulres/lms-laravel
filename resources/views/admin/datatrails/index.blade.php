@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.datatrail.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.datatrail.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">

                @can('datatrail_create')
                    <a href="{{ route('admin.datatrails.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add Data trail
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.datatrails.index') }}" class="grey-text {{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.datatrails.index') }}?show_deleted=1" class="grey-text {{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>
    
    <div class="card">
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="content">
            <table class="table table-striped ajaxTable @can('datatrail_delete') @if ( request('show_deleted') != 1 ) dt-select @else dt-show @endif @endcan">
                <thead>
                    <tr>
                        <th></th>
                        @can('datatrail_delete')
                            @if ( request('show_deleted') != 1 )<th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>@endif
                        @endcan

                        <th>@lang('global.datatrail.fields.view')</th>
                        <th>@lang('global.datatrail.fields.progress')</th>
                        <th>@lang('global.datatrail.fields.rating')</th>
                        <th>@lang('global.datatrail.fields.testimonal')</th>
                        <th>@lang('global.datatrail.fields.user')</th>
                        <th>@lang('global.datatrail.fields.trail')</th>
                        <th>@lang('global.datatrail.fields.certificate')</th>
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
        @can('datatrail_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.datatrails.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.datatrails.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [
                {data: 'view', name: 'view'},
                @can('datatrail_delete')
                    @if ( request('show_deleted') != 1 )
                        {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                    @endif
                @endcan
                {data: 'view', name: 'view'},
                {data: 'progress', name: 'progress'},
                {data: 'rating', name: 'rating'},
                {data: 'testimonal', name: 'testimonal'},
                {data: 'user.name', name: 'user.name'},
                {data: 'trail.title', name: 'trail.title'},
                {data: 'certificate.title', name: 'certificate.title'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection