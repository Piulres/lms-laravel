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
                            <th>@lang('global.trails.fields.title')</th>
                            <td field-key='title'>{{ $trail->title }}</td>
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
                            <th>@lang('global.trails.fields.courses')</th>
                            <td field-key='courses'>
                                @foreach ($trail->courses as $singleCourses)
                                    <span class="label label-info label-many">{{ $singleCourses->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#datatrails" aria-controls="datatrails" role="tab" data-toggle="tab">Data Trails</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="datatrails">
<table class="table table-bordered table-striped {{ count($datatrails) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.datatrails.fields.trail')</th>
                        <th>@lang('global.datatrails.fields.user')</th>
                        <th>@lang('global.datatrails.fields.view')</th>
                        <th>@lang('global.datatrails.fields.progress')</th>
                        <th>@lang('global.datatrails.fields.rating')</th>
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
                    <td field-key='trail'>{{ $datatrail->trail->title or '' }}</td>
                                <td field-key='user'>{{ $datatrail->user->name or '' }}</td>
                                <td field-key='view'>{{ Form::checkbox("view", 1, $datatrail->view == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='progress'>{{ $datatrail->progress }}</td>
                                <td field-key='rating'>{{ $datatrail->rating }}</td>
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
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
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


