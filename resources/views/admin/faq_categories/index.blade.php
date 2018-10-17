@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m8"><h1>@lang('global.faq-categories.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.faq-categories.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m4 right-align">

                @can('faq_category_create')
                    <a href="{{ route('admin.faq_categories.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add Category
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="content">
            <table class="no-order table table-striped ajaxTable @can('faq_category_delete') dt-select @else dt-show @endcan">
                <thead>
                    <tr>
                        <th></th>
                        @can('faq_category_delete')
                            <th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>
                        @endcan

                        <th>@lang('global.faq-categories.fields.title')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('faq_category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.faq_categories.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.faq_categories.index') !!}';
            window.dtDefaultOptions.columns = [
                {data: 'title', name: 'title'},
                @can('faq_category_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan
                {data: 'title', name: 'title'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection