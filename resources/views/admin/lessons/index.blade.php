@inject('request', 'Illuminate\Http\Request')
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
                    <li><span>@lang('global.lessons.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">

                @can('lesson_create')
                    <a href="{{ route('admin.lessons.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add Lesson
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <ul class="tabs z-depth-1">
        <li class="tab">
            <a href="{{ route('admin.lessons.index') }}" class="{{ request('show_deleted') == 1 ? '' : 'active' }}">@lang('global.app_all')</a>
        </li>
        <li class="tab">
            <a href="{{ route('admin.lessons.index') }}?show_deleted=1" class="{{ request('show_deleted') == 1 ? 'active' : '' }}">@lang('global.app_trash')</a>
        </li>
    </ul>

    <div class="card">
        <div class="title">
            <h3>@lang('global.app_list')</h3>
            <div class="toggle-view">
                <a href="#" id="list-view" class="active"><i class="fas fa-list-ul"></i></a>
                <a href="#" id="grid-view"><i class="fas fa-th"></i></a>
            </div>
        </div>

        <div class="content">
            <ul id="view" class="view list-view">
                @if (count($lessons) > 0)
                @foreach ($lessons as $lesson)
                <li class="item">
                    <div class="contain" @if($lesson->featured_image) style="background-image: url('{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->featured_image) }}'); " @endif>
                        <div class="left">
                            {{--<div class="drag-me">--}}
                                {{--<i class="fas fa-plus"></i>--}}
                            {{--</div>--}}
                            <div class="infos">
                                <h3>{{ $lesson->title }} <span>{{ $lesson->slug }}</span></h3>
                            </div>
                        </div>
                        <div class="bottom">
                            <div class="buttons">
                                @if( request('show_deleted') == 1 )
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.lessons.restore', $lesson->id])) !!}
                                    {!! Form::button('<i class="far fa-window-restore"></i>', ['class'=>'btn-square blue-text', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.lessons.perma_del', $lesson->id])) !!}
                                    {!! Form::button('<i class="fas fa-trash-alt"></i>', ['class'=>'btn-square red-text', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @else
                                    @can('lesson_view')
                                    <a href="{{ route('admin.lessons.show',[$lesson->id]) }}" class="btn-square amber-text"><i class="far fa-eye"></i></a>
                                    @endcan
                                    @can('lesson_edit')
                                    <a href="{{ route('admin.lessons.edit',[$lesson->id]) }}" class="btn-square blue-text"><i class="far fa-edit"></i></a>
                                    @endcan
                                    @can('lesson_access')
                                    {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'POST',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.lessons.duplicate', $lesson->id])) !!}
                                    {!! Form::button('<i class="far fa-clone"></i>', ['class'=>'btn-square red-text', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    @can('lesson_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.lessons.destroy', $lesson->id])) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'btn-square red-text', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                @endif
                                <a href="#" class="expand btn-square">
                                    <span class="up">
                                        <i class="fas fa-caret-down"></i>
                                    </span>
                                    <span class="down">
                                        <i class="fas fa-caret-up"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="expand-contain">
                        <div class="introduction-item">
                            <h4>@lang('global.lessons.fields.introduction')</h4>
                            {!! $lesson->introduction !!}
                        </div>
                        {{--<div class="content-item">--}}
                            {{--<h4>@lang('global.lessons.fields.content')</h4>--}}
                            {{--{!! $lesson->content !!}--}}
                        {{--</div>--}}
                        @if($lesson->study_material)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $lesson->study_material) }}" download class="download">
                            <i class="fas fa-file-download"></i>
                            <span>Download file</span>
                        </a>
                        @endif
                    </div>
                </li>
                @endforeach
                @endif
            </div>
            @if($courses)
                <div id="drop-area" class="drop-area">
                    <div>
                        @foreach($courses as $course)
                            <div class="drop-area__item fas fa-plus">
                                <span class="dummy"> {!! $course->title !!} </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- <table class="striped responsive-table ajaxTable dt-select">
                <thead>
                    <tr>
                        <th>@lang('global.lessons.fields.order')</th>
                        @can('lesson_delete')
                        @if ( request('show_deleted') != 1 )<th><input type="checkbox" id="select-all" /><label for="select-all"></label></th>@endif
            @endcan
            <th>@lang('global.lessons.fields.title')</th>
                        <th>@lang('global.lessons.fields.slug')</th>
                        <th>@lang('global.lessons.fields.introduction')</th>
                        <th>@lang('global.lessons.fields.content')</th>
                        <th>@lang('global.lessons.fields.study-material')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($lessons) > 0)
            @foreach ($lessons as $lesson)
            <tr data-entry-id="{{ $lesson->id }}">
                <td field-key='order' class="reorder">{{ $lesson->order }}</td>
                @can('lesson_delete')
                @if ( request('show_deleted') != 1 )<td></td>@endif
                @endcan
                <td field-key='title'>{{ $lesson->title }}</td>
                <td field-key='slug'>{{ $lesson->slug }}</td>
                <td field-key='introduction'>{!! $lesson->introduction !!}</td>
                <td field-key='content'>{!! $lesson->content !!}</td>
                <td field-key='study_material'>@if($lesson->study_material)<a href="{{ asset(env('UPLOAD_PATH').'/' . $lesson->study_material) }}" target="_blank">Download file</a>@endif</td>
                @if( request('show_deleted') == 1 )
                <td>
                {!! Form::open(array(
                    'style' => 'display: inline-block;',
                    'method' => 'POST',
                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                    'route' => ['admin.lessons.restore', $lesson->id])) !!}
                {!! Form::submit(trans('global.app_restore'), array('class' => 'btn-square blue-text')) !!}
                {!! Form::close() !!}
                {!! Form::open(array(
                    'style' => 'display: inline-block;',
                    'method' => 'DELETE',
                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                    'route' => ['admin.lessons.perma_del', $lesson->id])) !!}
                {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn-square red-text')) !!}
                {!! Form::close() !!}
            </td>
            @else
                <td>
                    <div class="buttons">
                @can('lesson_view')
                    <a href="{{ route('admin.lessons.show',[$lesson->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                @can('lesson_edit')
                    <a href="{{ route('admin.lessons.edit',[$lesson->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                        @endcan
                @can('lesson_delete')
                    {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.lessons.destroy', $lesson->id])) !!}
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
                        <td colspan="11">@lang('global.app_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table> -->
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('lesson_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.lessons.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection