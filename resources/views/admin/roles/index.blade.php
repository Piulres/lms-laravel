@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>
            @lang('global.roles.title')
        </h4>
        @can('role_create')
            <a href="{{ route('admin.roles.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>

    

    <div class="card">

        <div class="card-content">
            <div class="title">
                <h5>@lang('global.app_list')</h5>
            </div>
            <table class="striped {{ count($roles) > 0 ? 'datatable' : '' }} @can('role_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('role_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.roles.fields.title')</th>
                        <th>@lang('global.roles.fields.permission')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($roles) > 0)
                        @foreach ($roles as $role)
                            <tr data-entry-id="{{ $role->id }}">
                                @can('role_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $role->title }}</td>
                                <td field-key='permission'>
                                    @foreach ($role->permission as $singlePermission)
                                        <span class="label label-info label-many">{{ $singlePermission->title }}</span>
                                    @endforeach
                                </td>
                                <td class="actions">
                                    <div class="buttons d-flex justify-content-end">
                                        @can('role_view')
                                        <a href="{{ route('admin.roles.show',[$role->id]) }}"  class="waves-effect waves-light btn-small btn-square amber"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('role_edit')
                                        <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('role_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.roles.destroy', $role->id])) !!}
                                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('role_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.roles.mass_destroy') }}';
        @endcan

    </script>
@endsection