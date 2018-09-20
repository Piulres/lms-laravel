@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h2>@lang('global.teams.title')</h2>
        @can('team_create')
            <a href="{{ route('admin.teams.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="card-content">
            <table class="striped responsive-table {{ count($teams) > 0 ? 'datatable' : '' }} @can('team_delete') dt-select @endcan">
                <thead>
                    <tr>
                        <th>@lang('global.app_order')</th>
                        @can('team_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.teams.fields.name')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($teams) > 0)
                        @foreach ($teams as $team)
                            <tr data-entry-id="{{ $team->id }}">
                                <td>1</td>
                                @can('team_delete')
                                    <td></td>
                                @endcan
                                <td field-key='name'>{{ $team->name }}</td>
                                <td>
                                    <div class="buttons d-flex justify-content-center">
                                        @can('team_view')
                                        <a href="{{ route('admin.teams.show',[$team->id]) }}" class="waves-effect waves-light btn-small btn-square amber"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('team_edit')
                                        <a href="{{ route('admin.teams.edit',[$team->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('team_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.teams.destroy', $team->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('team_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.teams.mass_destroy') }}';
        @endcan

    </script>
@endsection