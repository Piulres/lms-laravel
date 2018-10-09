@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.coursescertificates.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.coursescertificates.index') }}">
                            @lang('global.coursescertificates.title')</a>
                    </li> /
                    <li><span>{{ $coursescertificate->title }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.coursescertificates.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                    <table class="table table-striped">
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
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#datacourse">Data Course</a></li>
            </ul>
        </div>

        <div class="content">
            
            <div class="active" id="datacourse">
                <table class="striped responsive-table {{ count($datacourses) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th class="order-null"></th>
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
                                    <td class="order-null"></td>
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
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn-square blue-text')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.datacourses.perma_del', $datacourse->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn-square red-text')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        <div class="buttons">
                                            @can('datacourse_view')
                                            <a href="{{ route('admin.datacourses.show',[$datacourse->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('datacourse_edit')
                                            <a href="{{ route('admin.datacourses.edit',[$datacourse->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('datacourse_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.datacourses.destroy', $datacourse->id])) !!}
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
                                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


