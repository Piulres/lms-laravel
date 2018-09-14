@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.trailscategories.title')</h4>
    </div>

    <div class="card">

        <div class="card-content">
            <div class="title col-12">
                <h5>@lang('global.app_view')</h5>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.trailscategories.fields.title')</th>
                            <td field-key='title'>{{ $trailscategory->title }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#trails">Trails</a></li>
            </ul>
        </div>
        <div class="card-content">
            <div class="active" id="trails">
                <table class="striped responsive-table {{ count($trails) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>@lang('global.trails.fields.title')</th>
                            <th>@lang('global.trails.fields.categories')</th>
                            <th>@lang('global.trails.fields.courses')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($trails) > 0)
                            @foreach ($trails as $trail)
                                <tr data-entry-id="{{ $trail->id }}">
                                    <td field-key='title'>{{ $trail->title }}</td>
                                    <td field-key='categories'>
                                        @foreach ($trail->categories as $singleCategories)
                                            <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='courses'>
                                        @foreach ($trail->courses as $singleCourses)
                                            <span class="label label-info label-many">{{ $singleCourses->title }}</span>
                                        @endforeach
                                    </td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.trails.restore', $trail->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.trails.perma_del', $trail->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('trail_view')
                                        <a href="{{ route('admin.trails.show',[$trail->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('trail_edit')
                                        <a href="{{ route('admin.trails.edit',[$trail->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('trail_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.trails.destroy', $trail->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


