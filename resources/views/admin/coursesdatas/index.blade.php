@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.coursesdata.title')</h3>
    @can('coursesdatum_create')
    <p>
        <a href="{{ route('admin.coursesdatas.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.coursesdatas.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.coursesdatas.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('coursesdatum_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('coursesdatum_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.coursesdata.fields.view')</th>
                        <th>@lang('global.coursesdata.fields.progress')</th>
                        <th>@lang('global.coursesdata.fields.rating')</th>
                        <th>@lang('global.coursesdata.fields.testimonal')</th>
                        <th>@lang('global.coursesdata.fields.user')</th>
                        <th>@lang('global.coursesdata.fields.course')</th>
                        <th>@lang('global.coursesdata.fields.certificate')</th>
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
        @can('coursesdatum_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.coursesdatas.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.coursesdatas.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('coursesdatum_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'view', name: 'view'},
                {data: 'progress', name: 'progress'},
                {data: 'rating', name: 'rating'},
                {data: 'testimonal', name: 'testimonal'},
                {data: 'user.name', name: 'user.name'},
                {data: 'course.title', name: 'course.title'},
                {data: 'certificate.title', name: 'certificate.title'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection