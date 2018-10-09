@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.lessons.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.lessons.index') }}">
                            @lang('global.lessons.title')</a>
                    </li> /
                    <li><span>{{ $lesson->title }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.lessons.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h5>@lang('global.app_view')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col s6">
                    <table class="bordered striped">
                        <tr>
                            <th>@lang('global.lessons.fields.order')</th>
                            <td field-key='order'>{{ $lesson->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.title')</th>
                            <td field-key='title'>{{ $lesson->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.slug')</th>
                            <td field-key='slug'>{{ $lesson->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.introduction')</th>
                            <td field-key='introduction'>{!! $lesson->introduction !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.content')</th>
                            <td field-key='content'>{!! $lesson->content !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.study-material')</th>
                            <td>
                            @if($lesson->study_material)
                                <a href="{{ asset(env('UPLOAD_PATH').'/' . $lesson->study_material) }}" download class="btn btn-small">
                                    Download file <i class="mdi-file-file-download"></i>
                                </a>
                            @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#courses" aria-controls="courses">Courses</a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="content">
            
            <div role="tabpanel" class="tab-pane active" id="courses">
                <table class="no-order striped responsive-table {{ count($courses) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>@lang('global.courses.fields.order')</th>
                            <th></th>
                            <th>@lang('global.courses.fields.title')</th>
                            <th>@lang('global.courses.fields.slug')</th>
                            {{--<th>@lang('global.courses.fields.description')</th>--}}
                            {{--<th>@lang('global.courses.fields.introduction')</th>--}}
{{--                            <th>@lang('global.courses.fields.featured-image')</th>--}}
                            <th>@lang('global.courses.fields.instructor')</th>
{{--                            <th>@lang('global.courses.fields.lessons')</th>--}}
                            <th>@lang('global.courses.fields.duration')</th>
                            <th>@lang('global.courses.fields.start-date')</th>
                            <th>@lang('global.courses.fields.end-date')</th>
                            {{--<th>@lang('global.courses.fields.categories')</th>--}}
                            {{--<th>@lang('global.courses.fields.tags')</th>--}}
                            <th>@lang('global.courses.fields.approved')</th>
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
                                    <td field-key='order'>{{ $course->order }}</td>
                                    <td></td>
                                    <td field-key='title'>{{ $course->title }}</td>
                                    <td field-key='slug'>{{ $course->slug }}</td>
                                    {{--<td field-key='description'>{!! $course->description !!}</td>--}}
                                    {{--<td field-key='introduction'>{!! $course->introduction !!}</td>--}}
                                    {{--<td field-key='featured_image'>@if($course->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $course->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->featured_image) }}"/></a>@endif</td>--}}
                                    <td field-key='instructor'>
                                        @foreach ($course->instructor as $singleInstructor)
                                            <span class="label label-info label-many">{{ $singleInstructor->name }}</span>
                                        @endforeach
                                    </td>
                                    {{--<td field-key='lessons'>--}}
                                        {{--@foreach ($course->lessons as $singleLessons)--}}
                                            {{--<span class="label label-info label-many">{{ $singleLessons->title }}</span>--}}
                                        {{--@endforeach--}}
                                    {{--</td>--}}
                                    <td field-key='duration'>{{ $course->duration }}</td>
                                    <td field-key='start_date'>{{ $course->start_date }}</td>
                                    <td field-key='end_date'>{{ $course->end_date }}</td>
                                    {{--<td field-key='categories'>--}}
                                        {{--@foreach ($course->categories as $singleCategories)--}}
                                            {{--<span class="label label-info label-many">{{ $singleCategories->title }}</span>--}}
                                        {{--@endforeach--}}
                                    {{--</td>--}}
                                    {{--<td field-key='tags'>--}}
                                        {{--@foreach ($course->tags as $singleTags)--}}
                                            {{--<span class="label label-info label-many">{{ $singleTags->title }}</span>--}}
                                        {{--@endforeach--}}
                                    {{--</td>--}}
                                    <td field-key='approved'>{{ Form::checkbox("approved", 1, $course->approved == 1 ? true : false, ["disabled"]) }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.courses.restore', $course->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn-square blue-text')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.courses.perma_del', $course->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn-square red-text')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        <div class="buttons">
                                            @can('course_view')
                                            <a href="{{ route('admin.courses.show',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('course_edit')
                                            <a href="{{ route('admin.courses.edit',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('course_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.courses.destroy', $course->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="19">@lang('global.app_no_entries_in_table')</td>
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
    <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
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
