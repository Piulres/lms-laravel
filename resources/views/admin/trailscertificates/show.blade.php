@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.trailscertificates.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.trailscertificates.title')</h2>
    </div>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_view')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-md-6">
                    <table class="striped">
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
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#datatrail">Data Trail</a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="card-content">
            
            <div class="active" id="datatrail">
                <table class="striped responsive-table {{ count($datatrails) > 0 ? 'datatable' : '' }}">
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
                                        <a href="{{ route('admin.datatrails.show',[$datatrail->id]) }}" class="waves-effect waves-light btn-small btn-square grey"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('datatrail_edit')
                                        <a href="{{ route('admin.datatrails.edit',[$datatrail->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('datatrail_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.datatrails.destroy', $datatrail->id])) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
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
    </div>
@stop


