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
                    <li>
                        <a href="{{ route('admin.lessons.index') }}">
                            @lang('global.lessons.title')</a>
                    </li> /
                    <li><span>@lang('global.app_create')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.lessons.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    {!! Form::open(['method' => 'POST', 'route' => ['admin.lessons.store'], 'files' => true,]) !!}
    <div class="row">
        <div class="col l9 m8 s12">
            <div class="card">
                <div class="title">
                    <h5>@lang('global.app_create')</h5>
                </div>

                <div class="content">
                    <div class="row">

                        <div class="col s12">
                            <div class="input-field">
                                {!! Form::label('title', trans('global.lessons.fields.title').'') !!}
                                {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                                <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                            </div>
                        </div>

                        <div class="col s12">
                            <div class="input-field">
                                {!! Form::label('introduction', trans('global.lessons.fields.introduction').'') !!}
                                {!! Form::textarea('introduction', old('introduction'), ['class' => 'materialize-textarea ']) !!}
                                <span class="helper-text" data-error="@if($errors->has('introduction')){{ $errors->first('introduction') }}@endif" data-success="right"></span>
                            </div>
                        </div>

                        <div class="col s12">
                            <div class="row">
                                <div class="col s12">
                                    <div class="file-field input-field">
                                        <div class="btn grey">
                                            <span>File</span>
                                            {!! Form::file('study_material') !!}
                                        </div>
                                        <div class="file-path-wrapper">
                                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => trans('global.lessons.fields.study-material')]) !!}
                                        </div>
                                        {!! Form::hidden('study_material', old('study_material')) !!}
                                        {!! Form::hidden('study_material_max_size', 5) !!}
                                    </div>
                                    <span class="helper-text" data-error="@if($errors->has('study_material')){{ $errors->first('study_material') }}@endif" data-success="right"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col s12">
                            {!! Form::label('content', trans('global.lessons.fields.content').'') !!}
                            {!! Form::textarea('content', old('content'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                            <span class="helper-text" data-error="@if($errors->has('content')){{ $errors->first('content') }}@endif" data-success="right"></span>
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
                    <div class="row">
                        <div class="col s6">
                            <div class="input-field">
                                {!! Form::label('order', trans('global.lessons.fields.order').'') !!}
                                {!! Form::number('order', old('order'), ['class' => 'validate']) !!}
                                <span class="helper-text" data-error="@if($errors->has('order')){{ $errors->first('order') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="input-field">
                                {!! Form::label('slug', trans('global.lessons.fields.slug').'') !!}
                                {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                                <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light right']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop