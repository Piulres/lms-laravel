@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.generals.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.general.title')</h2>
    </div>    
    {!! Form::model($general, ['method' => 'PUT', 'route' => ['admin.generals.update', $general->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('site_name', trans('global.general.fields.site-name').'') !!}
                        {!! Form::text('site_name', old('site_name'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('site_name')){{ $errors->first('site_name') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            <div class="file-field input-field">
                                <div class="btn grey">
                                    <span>File</span>
                                    {!! Form::file('site_logo') !!}
                                </div>
                                <div class="file-path-wrapper">
                                    {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => trans('global.lessons.fields.study-material')]) !!}
                                </div>
                                {!! Form::hidden('site_logo_max_size', 4) !!}
                                {!! Form::hidden('site_logo_max_width', 4096) !!}
                                {!! Form::hidden('site_logo_max_height', 4096) !!}
                            </div>
                            <span class="helper-text" data-error="@if($errors->has('site_logo')){{ $errors->first('site_logo') }}@endif" data-success="right"></span>
                        </div>
                        @if ($general->site_logo)
                            <a href="{{ asset(env('UPLOAD_PATH').'/'.$general->site_logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$general->site_logo) }}"></a>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('theme_color', trans('global.general.fields.theme-color').'') !!}
                    <span class="helper-text" data-error="@if($errors->has('theme_color')){{ $errors->first('theme_color') }}@endif" data-success="right"></span>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'red', false, ['class' => 'with-gap']) !!}
                            <span>Red</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'pink', false, ['class' => 'with-gap']) !!}
                            <span>Pink</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'purple', false, ['class' => 'with-gap']) !!}
                            <span>Purple</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'deep-purple', false, ['class' => 'with-gap']) !!}
                            <span>Deep Purple</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'indigo', false, ['class' => 'with-gap']) !!}
                            <span>Indigo</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'blue', false, ['class' => 'with-gap']) !!}
                            <span>Blue</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'light-blue', false, ['class' => 'with-gap']) !!}
                            <span>Light Blue</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'cyan', false, ['class' => 'with-gap']) !!}
                            <span>Cyan</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'teal', false, ['class' => 'with-gap']) !!}
                            <span>Teal</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'green', false, ['class' => 'with-gap']) !!}
                            <span>Green</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'light-green', false, ['class' => 'with-gap']) !!}
                            <span>Light Green</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'lime', false, ['class' => 'with-gap']) !!}
                            <span>Lime</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'yellow', false, ['class' => 'with-gap']) !!}
                            <span>Yellow</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'amber', false, ['class' => 'with-gap']) !!}
                            <span>Amber</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'orange', false, ['class' => 'with-gap']) !!}
                            <span>Orange</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'deep-orange', false, ['class' => 'with-gap']) !!}
                            <span>Deep Orange</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'brown', false, ['class' => 'with-gap']) !!}
                            <span>Brown</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'grey', false, ['class' => 'with-gap']) !!}
                            <span>Grey</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('theme_color', 'blue-grey', false, ['class' => 'with-gap']) !!}
                            <span>Blue Grey</span>
                        </label>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
    {!! Form::close() !!}
@stop

