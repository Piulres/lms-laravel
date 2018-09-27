@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.lessons.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.lessons.title')</h2>
    </div>    
    {!! Form::model($lesson, ['method' => 'PUT', 'route' => ['admin.lessons.update', $lesson->id], 'files' => true,]) !!}

    <div class="card">
        <div class="title">
            <h5>@lang('global.app_edit')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('order', trans('global.lessons.fields.order').'') !!}
                        {!! Form::number('order', old('order'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('order')){{ $errors->first('order') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.lessons.fields.title').'') !!}
                        {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('slug', trans('global.lessons.fields.slug').'') !!}
                        {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('introduction', trans('global.lessons.fields.introduction').'') !!}
                        {!! Form::textarea('introduction', old('introduction'), ['class' => 'materialize-textarea ', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('introduction')){{ $errors->first('introduction') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="row">
                        <div class="col-12 no-padding">
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
                            @if ($lesson->study_material)
                                <a href="{{ asset(env('UPLOAD_PATH').'/' . $lesson->study_material) }}" target="_blank">Download file</a>
                            @endif
                            <span class="helper-text" data-error="@if($errors->has('study_material')){{ $errors->first('study_material') }}@endif" data-success="right"></span>
                        </div>
                    </div>
                </div>

                <div class="col s12">
                    <div class="input-field">
                        {!! Form::label('content', trans('global.lessons.fields.content').'') !!}
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('content')){{ $errors->first('content') }}@endif" data-success="right"></span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
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