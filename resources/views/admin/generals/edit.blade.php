@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.general.title')</h3>
    
    {!! Form::model($general, ['method' => 'PUT', 'route' => ['admin.generals.update', $general->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('site_name', trans('global.general.fields.site-name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('site_name', old('site_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('site_name'))
                        <p class="help-block">
                            {{ $errors->first('site_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($general->site_logo)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$general->site_logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$general->site_logo) }}"></a>
                    @endif
                    {!! Form::label('site_logo', trans('global.general.fields.site-logo').'', ['class' => 'control-label']) !!}
                    {!! Form::file('site_logo', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('site_logo_max_size', 4) !!}
                    {!! Form::hidden('site_logo_max_width', 4096) !!}
                    {!! Form::hidden('site_logo_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('site_logo'))
                        <p class="help-block">
                            {{ $errors->first('site_logo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('theme_color', trans('global.general.fields.theme-color').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('theme_color'))
                        <p class="help-block">
                            {{ $errors->first('theme_color') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'red', false, []) !!}
                            Red
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'pink', false, []) !!}
                            Pink
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'purple', false, []) !!}
                            Purple
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'deep-purple', false, []) !!}
                            Deep Purple
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'indigo', false, []) !!}
                            Indigo
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'blue', false, []) !!}
                            Blue
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'light-blue', false, []) !!}
                            Light Blue
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'cyan', false, []) !!}
                            Cyan
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'teal', false, []) !!}
                            Teal
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'green', false, []) !!}
                            Green
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'light-green', false, []) !!}
                            Light Green
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'lime', false, []) !!}
                            Lime
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'yellow', false, []) !!}
                            Yellow
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'amber', false, []) !!}
                            Amber
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'orange', false, []) !!}
                            Orange
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'deep-orange', false, []) !!}
                            Deep Orange
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'brown', false, []) !!}
                            Brown
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'grey', false, []) !!}
                            Grey
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'blue-grey', false, []) !!}
                            Blue Grey
                        </label>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

