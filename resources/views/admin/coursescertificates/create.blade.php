@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.coursescertificates.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.coursescertificates.title')</h2>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.coursescertificates.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_create')</h3>
        </div>
        
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('order', trans('global.coursescertificates.fields.order').'') !!}
                        {!! Form::number('order', old('order'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('order')){{ $errors->first('order') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.coursescertificates.fields.title').'') !!}
                        {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('slug', trans('global.coursescertificates.fields.slug').'') !!}
                        {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="file-field input-field">
                        <div class="btn grey">
                            <span>File</span>
                            {!! Form::file('image') !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your avatar']) !!}
                        </div>
                        {!! Form::hidden('image_max_size', 4) !!}
                        {!! Form::hidden('image_max_width', 4096) !!}
                        {!! Form::hidden('image_max_height', 4096) !!}
                        <span class="helper-text" data-error="@if($errors->has('image')){{ $errors->first('image') }}@endif" data-success="right"></span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light grey']) !!}
    {!! Form::close() !!}
@stop

