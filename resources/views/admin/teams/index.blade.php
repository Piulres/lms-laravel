@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>
            @lang('global.teams.title')
        </h4>
        @can('team_create')
            <a href="{{ route('admin.teams.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>

    <div class="card">

        <div class="card-content">
            <div class="title">
                @lang('global.app_list')
            </div>
            <table class="striped ajaxTable @can('team_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('team_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.teams.fields.name')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('team_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.teams.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.teams.index') !!}';
            window.dtDefaultOptions.columns = [@can('team_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'name', name: 'name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection