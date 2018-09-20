@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.datatrails.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.datatrail.title')</h2>
    </div>

    {!! Form::open(['method' => 'POST', 'route' => ['admin.datatrails.store']]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_create')</h3>
        </div>
        
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('view', trans('global.datatrail.fields.view').'') !!}
                        {!! Form::number('view', old('view'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('view')){{ $errors->first('view') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('progress', trans('global.datatrail.fields.progress').'') !!}
                        {!! Form::number('progress', old('progress'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('progress')){{ $errors->first('progress') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('rating', trans('global.datatrail.fields.rating').'') !!}
                        {!! Form::number('rating', old('rating'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('rating')){{ $errors->first('rating') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('testimonal', trans('global.datatrail.fields.testimonal').'') !!}
                        {!! Form::textarea('testimonal', old('testimonal'), ['class' => 'materialize-textarea ', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('testimonal')){{ $errors->first('testimonal') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('user_id', trans('global.datatrail.fields.user').'') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('user_id')){{ $errors->first('user_id') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('trail_id', trans('global.datatrail.fields.trail').'') !!}
                    {!! Form::select('trail_id', $trails, old('trail_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('trail_id')){{ $errors->first('trail_id') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('certificate_id', trans('global.datatrail.fields.certificate').'') !!}
                    {!! Form::select('certificate_id', $certificates, old('certificate_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('certificate_id')){{ $errors->first('certificate_id') }}@endif" data-success="right"></span>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light grey']) !!}
    {!! Form::close() !!}
@stop

