@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m8"><h1>@lang('global.coursecategories.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.coursecategories.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m4 right-align">

                @can('coursecategory_create')
                    <a href="{{ route('admin.coursecategories.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add Category
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.coursecategories.index') }}" class="grey-text {{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.coursecategories.index') }}?show_deleted=1" class="grey-text {{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>

    <div class="card">
        <div class="title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="content">
            <table class="table table-striped no-order dataTable {{ count($coursecategories) > 0 ? 'datatable' : '' }} @can('coursecategory_delete') @if ( request('show_deleted') != 1 ) dt-select @else dt-show @endif @endcan no-order">
                <thead>
                    <tr>
                        <th class="order-null"></th>
                        @can('coursecategory_delete')
                            @if ( request('show_deleted') != 1 )<th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>@endif
                        @endcan

                        <th>@lang('global.coursecategories.fields.title')</th>
                        <th>@lang('global.coursecategories.fields.slug')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($coursecategories) > 0)
                        @foreach ($coursecategories as $coursecategory)
                            <tr data-entry-id="{{ $coursecategory->id }}">
                                <td class="order-null"></td>
                                @can('coursecategory_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='title'>{{ $coursecategory->title }}</td>
                                <td field-key='slug'>{{ $coursecategory->slug }}</td>
                                <td>
                                    <div class="buttons">
                                    @if( request('show_deleted') == 1 )
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.coursecategories.restore', $coursecategory->id])) !!}
                                    {!! Form::button('<i class="far fa-window-restore"></i>', ['class'=>'btn-square blue-text', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.coursecategories.perma_del', $coursecategory->id])) !!}
                                    {!! Form::button('<i class="fas fa-trash-alt"></i>', ['class'=>'btn-square red-text', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @else
                                        @can('coursecategory_view')
                                        <a href="{{ route('admin.coursecategories.show',[$coursecategory->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('coursecategory_edit')
                                        <a href="{{ route('admin.coursecategories.edit',[$coursecategory->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('coursecategory_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.coursecategories.destroy', $coursecategory->id])) !!}
                                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    @endif
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
        @can('coursecategory_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.coursecategories.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection