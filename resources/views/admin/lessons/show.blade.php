@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.lessons.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h4>@lang('global.lessons.title')</h4>
    </div>

    <div class="card">

        <div class="card-content">
            <div class="title col-md-6">
                <h5>@lang('global.app_view')</h5>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table class="striped">
                        <tr>
                            <th>@lang('global.lessons.fields.title')</th>
                            <td field-key='title'>{{ $lesson->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.introduction')</th>
                            <td field-key='introduction'>{!! $lesson->introduction !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.study-material')</th>
                            <td field-key='study_material's> @foreach($lesson->getMedia('study_material') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.content')</th>
                            <td field-key='content'>{!! $lesson->content !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab"><a href="#courses">Courses</a></li>
            </ul>
        </div>
        <div class="card-content">
            <div class="active" id="courses">
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
                                    <td class="actions">
                                        <div class="buttons d-flex justify-content-end">
                                            @can('course_view')
                                            <a href="{{ route('admin.courses.show',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('course_edit')
                                            <a href="{{ route('admin.courses.edit',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('course_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.courses.destroy', $course->id])) !!}
                                            {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
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
    </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop
