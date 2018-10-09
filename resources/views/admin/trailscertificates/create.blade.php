@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.trailscertificates.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.trailscertificates.index') }}">
                            @lang('global.trailscertificates.title')</a>
                    </li> /
                    <li><span>@lang('global.app_create')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.trailscertificates.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    {!! Form::open(['method' => 'POST', 'route' => ['admin.trailscertificates.store'], 'files' => true,]) !!}
    <div class="row">
        <div class="col l9 m8 s12">
            <div class="card">
                <div class="title">
                    <h5>@lang('global.app_create')</h5>
                </div>

                <div class="content">
                    <div class="row">

                        <div class="col m6 s12">
                            <div class="input-field">
                                {!! Form::label('title', trans('global.trailscertificates.fields.title').'') !!}
                                {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                                <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                            </div>
                        </div>

                        <div class="col m6 s12">
                            <div class="file-field input-field">
                                <div class="btn grey">
                                    <span>File</span>
                                    {!! Form::file('image') !!}
                                </div>
                                <div class="file-path-wrapper">
                                    {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your image']) !!}
                                </div>
                                {!! Form::hidden('image_max_size', 2) !!}
                                {!! Form::hidden('image_max_width', 4096) !!}
                                {!! Form::hidden('image_max_height', 4096) !!}
                                <span class="helper-text" data-error="@if($errors->has('image')){{ $errors->first('image') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m4 s12">
            <div class="card">
                <div class="title">
                    <h5>Informations</h5>
                    <a class="minimize" href="#" draggable="false"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content">
                    <div class="col m6 s12">
                        <div class="input-field">
                            {!! Form::label('order', trans('global.trailscertificates.fields.order').'') !!}
                            {!! Form::number('order', old('order'), ['class' => 'validate']) !!}
                            <span class="helper-text" data-error="@if($errors->has('order')){{ $errors->first('order') }}@endif" data-success="right"></span>
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="input-field">
                            {!! Form::label('slug', trans('global.trailscertificates.fields.slug').'') !!}
                            {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                            <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    {!! Form::button(trans('global.app_create') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop

