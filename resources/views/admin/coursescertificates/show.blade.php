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
    
<li role="presentation" class="active"><a href="#coursesdata" aria-controls="coursesdata" role="tab" data-toggle="tab">Data Courses</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="coursesdata">
<table class="table table-bordered table-striped {{ count($coursesdatas) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.coursesdata.fields.view')</th>
                        <th>@lang('global.coursesdata.fields.progress')</th>
                        <th>@lang('global.coursesdata.fields.rating')</th>
                        <th>@lang('global.coursesdata.fields.testimonal')</th>
                        <th>@lang('global.coursesdata.fields.user')</th>
                        <th>@lang('global.coursesdata.fields.course')</th>
                        <th>@lang('global.coursesdata.fields.certificate')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($coursesdatas) > 0)
            @foreach ($coursesdatas as $coursesdata)
                <tr data-entry-id="{{ $coursesdata->id }}">
                    <td field-key='view'>{{ $coursesdata->view }}</td>
                                <td field-key='progress'>{{ $coursesdata->progress }}</td>
                                <td field-key='rating'>{{ $coursesdata->rating }}</td>
                                <td field-key='testimonal'>{!! $coursesdata->testimonal !!}</td>
                                <td field-key='user'>{{ $coursesdata->user->name or '' }}</td>
                                <td field-key='course'>{{ $coursesdata->course->title or '' }}</td>
                                <td field-key='certificate'>{{ $coursesdata->certificate->title or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.coursesdatas.restore', $coursesdata->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.coursesdatas.perma_del', $coursesdata->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('coursesdatum_view')
                                    <a href="{{ route('admin.coursesdatas.show',[$coursesdata->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('coursesdatum_edit')
                                    <a href="{{ route('admin.coursesdatas.edit',[$coursesdata->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('coursesdatum_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.coursesdatas.destroy', $coursesdata->id])) !!}
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


