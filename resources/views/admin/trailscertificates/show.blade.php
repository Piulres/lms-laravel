@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.trailscertificates.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.trailscertificates.fields.order')</th>
                            <td field-key='order'>{{ $trailscertificate->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trailscertificates.fields.title')</th>
                            <td field-key='title'>{{ $trailscertificate->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trailscertificates.fields.slug')</th>
                            <td field-key='slug'>{{ $trailscertificate->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trailscertificates.fields.image')</th>
                            <td field-key='image'>@if($trailscertificate->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $trailscertificate->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $trailscertificate->image) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#traildata" aria-controls="traildata" role="tab" data-toggle="tab">Data Trail</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="traildata">
<table class="table table-bordered table-striped {{ count($traildatas) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.traildata.fields.view')</th>
                        <th>@lang('global.traildata.fields.progress')</th>
                        <th>@lang('global.traildata.fields.rating')</th>
                        <th>@lang('global.traildata.fields.testimonal')</th>
                        <th>@lang('global.traildata.fields.user')</th>
                        <th>@lang('global.traildata.fields.trail')</th>
                        <th>@lang('global.traildata.fields.certificate')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($traildatas) > 0)
            @foreach ($traildatas as $traildata)
                <tr data-entry-id="{{ $traildata->id }}">
                    <td field-key='view'>{{ $traildata->view }}</td>
                                <td field-key='progress'>{{ $traildata->progress }}</td>
                                <td field-key='rating'>{{ $traildata->rating }}</td>
                                <td field-key='testimonal'>{!! $traildata->testimonal !!}</td>
                                <td field-key='user'>{{ $traildata->user->name or '' }}</td>
                                <td field-key='trail'>{{ $traildata->trail->title or '' }}</td>
                                <td field-key='certificate'>{{ $traildata->certificate->title or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.traildatas.restore', $traildata->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.traildatas.perma_del', $traildata->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('traildatum_view')
                                    <a href="{{ route('admin.traildatas.show',[$traildata->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('traildatum_edit')
                                    <a href="{{ route('admin.traildatas.edit',[$traildata->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('traildatum_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.traildatas.destroy', $traildata->id])) !!}
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

            <a href="{{ route('admin.trailscertificates.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


