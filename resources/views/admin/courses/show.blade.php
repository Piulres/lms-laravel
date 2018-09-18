@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.courses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.courses.fields.order')</th>
                            <td field-key='order'>{{ $course->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.title')</th>
                            <td field-key='title'>{{ $course->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.slug')</th>
                            <td field-key='slug'>{{ $course->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.description')</th>
                            <td field-key='description'>{!! $course->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.introduction')</th>
                            <td field-key='introduction'>{!! $course->introduction !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.featured-image')</th>
                            <td field-key='featured_image'>@if($course->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $course->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->featured_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.instructor')</th>
                            <td field-key='instructor'>
                                @foreach ($course->instructor as $singleInstructor)
                                    <span class="label label-info label-many">{{ $singleInstructor->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.lessons')</th>
                            <td field-key='lessons'>
                                @foreach ($course->lessons as $singleLessons)
                                    <span class="label label-info label-many">{{ $singleLessons->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.duration')</th>
                            <td field-key='duration'>{{ $course->duration }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.start-date')</th>
                            <td field-key='start_date'>{{ $course->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.end-date')</th>
                            <td field-key='end_date'>{{ $course->end_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.categories')</th>
                            <td field-key='categories'>
                                @foreach ($course->categories as $singleCategories)
                                    <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.tags')</th>
                            <td field-key='tags'>
                                @foreach ($course->tags as $singleTags)
                                    <span class="label label-info label-many">{{ $singleTags->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $course->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#datacourse" aria-controls="datacourse" role="tab" data-toggle="tab">Data Course</a></li>
<li role="presentation" class=""><a href="#trails" aria-controls="trails" role="tab" data-toggle="tab">Trails</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="datacourse">
<table class="table table-bordered table-striped {{ count($datacourses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.datacourse.fields.view')</th>
                        <th>@lang('global.datacourse.fields.progress')</th>
                        <th>@lang('global.datacourse.fields.rating')</th>
                        <th>@lang('global.datacourse.fields.testimonal')</th>
                        <th>@lang('global.datacourse.fields.user')</th>
                        <th>@lang('global.datacourse.fields.course')</th>
                        <th>@lang('global.datacourse.fields.certificate')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($datacourses) > 0)
            @foreach ($datacourses as $datacourse)
                <tr data-entry-id="{{ $datacourse->id }}">
                    <td field-key='view'>{{ $datacourse->view }}</td>
                                <td field-key='progress'>{{ $datacourse->progress }}</td>
                                <td field-key='rating'>{{ $datacourse->rating }}</td>
                                <td field-key='testimonal'>{!! $datacourse->testimonal !!}</td>
                                <td field-key='user'>{{ $datacourse->user->name or '' }}</td>
                                <td field-key='course'>{{ $datacourse->course->title or '' }}</td>
                                <td field-key='certificate'>{{ $datacourse->certificate->title or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datacourses.restore', $datacourse->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datacourses.perma_del', $datacourse->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('datacourse_view')
                                    <a href="{{ route('admin.datacourses.show',[$datacourse->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('datacourse_edit')
                                    <a href="{{ route('admin.datacourses.edit',[$datacourse->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('datacourse_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datacourses.destroy', $datacourse->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="trails">
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

            <a href="{{ route('admin.courses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
