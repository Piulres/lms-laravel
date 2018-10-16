@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m8"><h1>@lang('global.content-categories.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.content-categories.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m4 right-align">

                @can('content_category_create')
                    <a href="{{ route('admin.content_categories.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
            <table class="table table-striped no-order dataTable {{ count($content_categories) > 0 ? 'datatable' : '' }} @can('content_category_delete') dt-select @else dt-show @endcan">
                <thead>
                    <tr>
                        <th class="order-null"></th>
                        @can('content_category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /><label
                                        for="select-all"></label></th>
                        @endcan

                        <th>@lang('global.content-categories.fields.title')</th>
                        <th>@lang('global.content-categories.fields.slug')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($content_categories) > 0)
                        @foreach ($content_categories as $content_category)
                            <tr data-entry-id="{{ $content_category->id }}">
                                <td class="order-null"></td>
                                @can('content_category_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $content_category->title }}</td>
                                <td field-key='slug'>{{ $content_category->slug }}</td>
                                <td>
                                    <div class="buttons">
                                        @can('content_category_view')
                                        <a href="{{ route('admin.content_categories.show',[$content_category->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('content_category_edit')
                                        <a href="{{ route('admin.content_categories.edit',[$content_category->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('content_category_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.content_categories.destroy', $content_category->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
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
        @can('content_category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.content_categories.mass_destroy') }}';
        @endcan

    </script>
@endsection