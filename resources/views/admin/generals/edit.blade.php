@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.general.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.generals.index') }}">
                            @lang('global.general.title')</a>
                    </li> /
                    <li><span>@lang('global.app_edit')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.generals.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>


    {!! Form::model($general, ['method' => 'PUT', 'route' => ['admin.generals.update', $general->id], 'files' => true,]) !!}
    <div class="card">
        <div class="title">
            <h5>@lang('global.app_edit')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('site_name', trans('global.general.fields.site-name').'') !!}
                        {!! Form::text('site_name', old('site_name'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('site_name')){{ $errors->first('site_name') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="row">
                        <div class="col-12 no-padding">
                            <div class="file-field input-field">
                                <div class="btn grey">
                                    <span>File</span>
                                    {!! Form::file('site_logo') !!}
                                </div>
                                <div class="file-path-wrapper">
                                    {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => trans('global.general.fields.site-logo')]) !!}
                                </div>
                                {!! Form::hidden('site_logo_max_size', 4) !!}
                                {!! Form::hidden('site_logo_max_width', 4096) !!}
                                {!! Form::hidden('site_logo_max_height', 4096) !!}
                            </div>
                            <span class="helper-text" data-error="@if($errors->has('site_logo')){{ $errors->first('site_logo') }}@endif" data-success="right"></span>
                        </div>
                    </div>
                </div>

                <div class="col s12">
                    <div class="col s12 no-padding">
                        {!! Form::label('theme_color', trans('global.general.fields.theme-color').'') !!}
                    </div>
                    <div class="col s12">
                        <div class="radio-color">
                            <p class="red">
                                {!! Form::radio('theme_color', 'red', false, ['class' => 'with-gap', 'id' => 'red']) !!}
                                <label for="red"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="pink">
                                {!! Form::radio('theme_color', 'pink', false, ['class' => 'with-gap', 'id' => 'pink']) !!}
                                <label for="pink"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="purple">
                                {!! Form::radio('theme_color', 'purple', false, ['class' => 'with-gap', 'id' => 'purple']) !!}
                                <label for="purple"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="deep-purple">
                                {!! Form::radio('theme_color', 'deep-purple', false, ['class' => 'with-gap', 'id' => 'deep-purple']) !!}
                                <label for="deep-purple"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="indigo">
                                {!! Form::radio('theme_color', 'indigo', false, ['class' => 'with-gap', 'id' => 'indigo']) !!}
                                <label for="indigo"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="blue">
                                {!! Form::radio('theme_color', 'blue', false, ['class' => 'with-gap', 'id' => 'blue']) !!}
                                <label for="blue"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="light-blue">
                                {!! Form::radio('theme_color', 'light-blue', false, ['class' => 'with-gap', 'id' => 'light-blue']) !!}
                                <label for="light-blue"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="cyan">
                                {!! Form::radio('theme_color', 'cyan', false, ['class' => 'with-gap', 'id' => 'cyan']) !!}
                                <label for="cyan"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="teal">
                                {!! Form::radio('theme_color', 'teal', false, ['class' => 'with-gap', 'id' => 'teal']) !!}
                                <label for="teal"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="green">
                                {!! Form::radio('theme_color', 'green', false, ['class' => 'with-gap', 'id' => 'green']) !!}
                                <label for="green"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="light-green">
                                {!! Form::radio('theme_color', 'light-green', false, ['class' => 'with-gap', 'id' => 'light-green']) !!}
                                <label for="light-green"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="lime">
                                {!! Form::radio('theme_color', 'lime', false, ['class' => 'with-gap', 'id' => 'lime']) !!}
                                <label for="lime"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="yellow">
                                {!! Form::radio('theme_color', 'yellow', false, ['class' => 'with-gap', 'id' => 'yellow']) !!}
                                <label for="yellow"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="amber">
                                {!! Form::radio('theme_color', 'amber', false, ['class' => 'with-gap', 'id' => 'amber']) !!}
                                <label for="amber"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="orange">
                                {!! Form::radio('theme_color', 'orange', false, ['class' => 'with-gap', 'id' => 'orange']) !!}
                                <label for="orange"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="deep-orange">
                                {!! Form::radio('theme_color', 'deep-orange', false, ['class' => 'with-gap', 'id' => 'deep-orange']) !!}
                                <label for="deep-orange"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="brown">
                                {!! Form::radio('theme_color', 'brown', false, ['class' => 'with-gap', 'id' => 'brown']) !!}
                                <label for="brown"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="grey">
                                {!! Form::radio('theme_color', 'grey', false, ['class' => 'with-gap', 'id' => 'grey']) !!}
                                <label for="grey"></label>
                            </p>
                        </div>
                        <div class="radio-color">
                            <p class="blue-grey">
                                {!! Form::radio('theme_color', 'blue-grey', false, ['class' => 'with-gap', 'id' => 'blue-grey']) !!}
                                <label for="blue-grey"></label>
                            </p>
                        </div>
                    </div>

                    <span class="helper-text" data-error="@if($errors->has('theme_color')){{ $errors->first('theme_color') }}@endif" data-success="right"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            {!! Form::button(trans('global.app_update') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@stop

