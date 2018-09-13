@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>
            @lang('global.courses.title')
            @can('course_create')
            <a href="{{ route('admin.courses.create') }}" class="btn-floating btn-small waves-effect waves-light"><i class="material-icons">add</i></a>
            @endcan
        </h4>
    </div>

    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.courses.index') }}" class="{{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.courses.index') }}?show_deleted=1" class="{{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>
    

    <div class="card">
        <div class="card-content">
            <div class="card-title">
                <h6>@lang('global.app_list')</h6>
            </div>

            <table class="striped ajaxTable @can('course_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan responsive-table">
                <thead>
                    <tr>
                        @can('course_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.courses.fields.title')</th>
                        <th>@lang('global.courses.fields.instructor')</th>
                        <th>@lang('global.courses.fields.lessons')</th>
                        <th>@lang('global.courses.fields.categories')</th>
                        <th>@lang('global.courses.fields.featured-image')</th>
                        <th>@lang('global.courses.fields.description')</th>
                        <th>@lang('global.courses.fields.introduction')</th>
                        <th>@lang('global.courses.fields.duration')</th>
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
        @can('course_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.courses.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.courses.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('course_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'title', name: 'title'},
                {data: 'instructor.name', name: 'instructor.name'},
                {data: 'lessons.title', name: 'lessons.title'},
                {data: 'categories.title', name: 'categories.title'},
                {data: 'featured_image', name: 'featured_image'},
                {data: 'description', name: 'description'},
                {data: 'introduction', name: 'introduction'},
                {data: 'duration', name: 'duration'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection