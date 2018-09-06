@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.coursescategories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.coursescategories.fields.title')</th>
                            <td field-key='title'>{{ $coursescategory->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#courses" aria-controls="courses" role="tab" data-toggle="tab">Courses</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="courses">
<table class="table table-bordered table-striped {{ count($courses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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

    <tbody>
        @if (count($courses) > 0)
            @foreach ($courses as $course)
                <tr data-entry-id="{{ $course->id }}">
                    <td field-key='title'>{{ $course->title }}</td>
                                <td field-key='instructor'>
                                    @foreach ($course->instructor as $singleInstructor)
                                        <span class="label label-info label-many">{{ $singleInstructor->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='lessons'>
                                    @foreach ($course->lessons as $singleLessons)
                                        <span class="label label-info label-many">{{ $singleLessons->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='categories'>
                                    @foreach ($course->categories as $singleCategories)
                                        <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='featured_image'>@if($course->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $course->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->featured_image) }}"/></a>@endif</td>
                                <td field-key='description'>{!! $course->description !!}</td>
                                <td field-key='introduction'>{!! $course->introduction !!}</td>
                                <td field-key='duration'>{{ $course->duration }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.courses.restore', $course->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.courses.perma_del', $course->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('course_view')
                                    <a href="{{ route('admin.courses.show',[$course->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('course_edit')
                                    <a href="{{ route('admin.courses.edit',[$course->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('course_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.courses.destroy', $course->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="13">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.coursescategories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


