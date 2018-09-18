@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.trailcategories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.trailcategories.fields.title')</th>
                            <td field-key='title'>{{ $trailcategory->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trailcategories.fields.slug')</th>
                            <td field-key='slug'>{{ $trailcategory->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#trails" aria-controls="trails" role="tab" data-toggle="tab">Trails</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="trails">
<table class="table table-bordered table-striped {{ count($trails) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.trails.fields.order')</th>
                        <th>@lang('global.trails.fields.title')</th>
                        <th>@lang('global.trails.fields.slug')</th>
                        <th>@lang('global.trails.fields.description')</th>
                        <th>@lang('global.trails.fields.introduction')</th>
                        <th>@lang('global.trails.fields.featured-image')</th>
                        <th>@lang('global.trails.fields.courses')</th>
                        <th>@lang('global.trails.fields.start-date')</th>
                        <th>@lang('global.trails.fields.end-date')</th>
                        <th>@lang('global.trails.fields.categories')</th>
                        <th>@lang('global.trails.fields.tags')</th>
                        <th>@lang('global.trails.fields.approved')</th>
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
                    <td field-key='order'>{{ $trail->order }}</td>
                                <td field-key='title'>{{ $trail->title }}</td>
                                <td field-key='slug'>{{ $trail->slug }}</td>
                                <td field-key='description'>{!! $trail->description !!}</td>
                                <td field-key='introduction'>{!! $trail->introduction !!}</td>
                                <td field-key='featured_image'>{{ $trail->featured_image }}</td>
                                <td field-key='courses'>
                                    @foreach ($trail->courses as $singleCourses)
                                        <span class="label label-info label-many">{{ $singleCourses->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='start_date'>{{ $trail->start_date }}</td>
                                <td field-key='end_date'>{{ $trail->end_date }}</td>
                                <td field-key='categories'>
                                    @foreach ($trail->categories as $singleCategories)
                                        <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='tags'>
                                    @foreach ($trail->tags as $singleTags)
                                        <span class="label label-info label-many">{{ $singleTags->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='approved'>{{ Form::checkbox("approved", 1, $trail->approved == 1 ? true : false, ["disabled"]) }}</td>
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
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.trailcategories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


