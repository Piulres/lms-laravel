@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.datacourses.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.datacourse.title')</h2>
    </div>    
    {!! Form::model($datacourse, ['method' => 'PUT', 'route' => ['admin.datacourses.update', $datacourse->id]]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('view', trans('global.datacourse.fields.view').'') !!}
                        {!! Form::number('view', old('view'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('view')){{ $errors->first('view') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('progress', trans('global.datacourse.fields.progress').'') !!}
                        {!! Form::number('progress', old('progress'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('progress')){{ $errors->first('progress') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('rating', trans('global.datacourse.fields.rating').'') !!}
                        {!! Form::number('rating', old('rating'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('rating')){{ $errors->first('rating') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('testimonal', trans('global.datacourse.fields.testimonal').'') !!}
                        {!! Form::textarea('testimonal', old('testimonal'), ['class' => 'materialize-textarea ', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('testimonal')){{ $errors->first('testimonal') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('user_id', trans('global.datacourse.fields.user').'') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('user_id')){{ $errors->first('user_id') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('course_id', trans('global.datacourse.fields.course').'') !!}
                    {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('course_id')){{ $errors->first('course_id') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('certificate_id', trans('global.datacourse.fields.certificate').'') !!}
                    {!! Form::select('certificate_id', $certificates, old('certificate_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('certificate_id')){{ $errors->first('certificate_id') }}@endif" data-success="right"></span>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
    {!! Form::close() !!}
@stop

