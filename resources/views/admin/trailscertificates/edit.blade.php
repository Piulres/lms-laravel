@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h2>@lang('global.trailscertificates.title')</h2>
    </div>
    
    {!! Form::model($trailscertificate, ['method' => 'PUT', 'route' => ['admin.trailscertificates.update', $trailscertificate->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('order', trans('global.trailscertificates.fields.order').'') !!}
                        {!! Form::number('order', old('order'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.trailscertificates.fields.title').'') !!}
                        {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('slug', trans('global.trailscertificates.fields.slug').'') !!}
                        {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="file-field input-field">
                        @if ($trailscertificate->image)
                            <a href="{{ asset(env('UPLOAD_PATH').'/'.$trailscertificate->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$trailscertificate->image) }}"></a>
                        @endif
                        <div class="btn grey">
                            <span>File</span>
                            {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your image']) !!}
                        </div>
                        {!! Form::hidden('image_max_size', 2) !!}
                        {!! Form::hidden('image_max_width', 4096) !!}
                        {!! Form::hidden('image_max_height', 4096) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
    {!! Form::close() !!}
@stop

