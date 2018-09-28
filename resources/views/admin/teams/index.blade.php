@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.teams.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.teams.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">

                @can('team_create')
                    <a href="{{ route('admin.teams.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add Team
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
            <table class="table table-striped no-order {{ count($teams) > 0 ? 'datatable' : '' }} @can('team_delete') dt-select @else dt-show @endcan">
                <thead>
                    <tr>
                        <th>@lang('global.app_order')</th>
                        @can('team_delete')
                            <th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>
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
                                        <a href="{{ route('admin.teams.show',[$team->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('team_edit')
                                        <a href="{{ route('admin.teams.edit',[$team->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('team_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.teams.destroy', $team->id])) !!}
                                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
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