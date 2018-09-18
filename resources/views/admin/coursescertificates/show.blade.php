@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.coursescertificates.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.coursescertificates.fields.order')</th>
                            <td field-key='order'>{{ $coursescertificate->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursescertificates.fields.title')</th>
                            <td field-key='title'>{{ $coursescertificate->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursescertificates.fields.slug')</th>
                            <td field-key='slug'>{{ $coursescertificate->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.coursescertificates.fields.image')</th>
                            <td field-key='image'>@if($coursescertificate->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $coursescertificate->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $coursescertificate->image) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#datacourse" aria-controls="datacourse" role="tab" data-toggle="tab">Data Course</a></li>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.coursescertificates.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


