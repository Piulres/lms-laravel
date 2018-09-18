@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.trails.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.trails.fields.order')</th>
                            <td field-key='order'>{{ $trail->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.title')</th>
                            <td field-key='title'>{{ $trail->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.slug')</th>
                            <td field-key='slug'>{{ $trail->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.description')</th>
                            <td field-key='description'>{!! $trail->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.introduction')</th>
                            <td field-key='introduction'>{!! $trail->introduction !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.featured-image')</th>
                            <td field-key='featured_image'>{{ $trail->featured_image }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.courses')</th>
                            <td field-key='courses'>
                                @foreach ($trail->courses as $singleCourses)
                                    <span class="label label-info label-many">{{ $singleCourses->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.start-date')</th>
                            <td field-key='start_date'>{{ $trail->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.end-date')</th>
                            <td field-key='end_date'>{{ $trail->end_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.categories')</th>
                            <td field-key='categories'>
                                @foreach ($trail->categories as $singleCategories)
                                    <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.tags')</th>
                            <td field-key='tags'>
                                @foreach ($trail->tags as $singleTags)
                                    <span class="label label-info label-many">{{ $singleTags->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $trail->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#datatrail" aria-controls="datatrail" role="tab" data-toggle="tab">Data Trail</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="datatrail">
<table class="table table-bordered table-striped {{ count($datatrails) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.datatrail.fields.view')</th>
                        <th>@lang('global.datatrail.fields.progress')</th>
                        <th>@lang('global.datatrail.fields.rating')</th>
                        <th>@lang('global.datatrail.fields.testimonal')</th>
                        <th>@lang('global.datatrail.fields.user')</th>
                        <th>@lang('global.datatrail.fields.trail')</th>
                        <th>@lang('global.datatrail.fields.certificate')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($datatrails) > 0)
            @foreach ($datatrails as $datatrail)
                <tr data-entry-id="{{ $datatrail->id }}">
                    <td field-key='view'>{{ $datatrail->view }}</td>
                                <td field-key='progress'>{{ $datatrail->progress }}</td>
                                <td field-key='rating'>{{ $datatrail->rating }}</td>
                                <td field-key='testimonal'>{!! $datatrail->testimonal !!}</td>
                                <td field-key='user'>{{ $datatrail->user->name or '' }}</td>
                                <td field-key='trail'>{{ $datatrail->trail->title or '' }}</td>
                                <td field-key='certificate'>{{ $datatrail->certificate->title or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datatrails.restore', $datatrail->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datatrails.perma_del', $datatrail->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('datatrail_view')
                                    <a href="{{ route('admin.datatrails.show',[$datatrail->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('datatrail_edit')
                                    <a href="{{ route('admin.datatrails.edit',[$datatrail->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('datatrail_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datatrails.destroy', $datatrail->id])) !!}
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.trails.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
