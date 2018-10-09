@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.datatrail.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.datatrails.index') }}">
                            @lang('global.datatrail.title')</a>
                    </li> /
                    <li><span>@lang('global.app_create')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.datatrails.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>


    {!! Form::open(['method' => 'POST', 'route' => ['admin.datatrails.store']]) !!}
    <div class="card">
        <div class="title">
            <h5>@lang('global.app_create')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col m4 s12">
                    <div class="input-field">
                        {!! Form::label('view', trans('global.datatrail.fields.view').'') !!}
                        {!! Form::number('view', old('view'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('view')){{ $errors->first('view') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m4 s12">
                    <div class="input-field">
                        {!! Form::label('progress', trans('global.datatrail.fields.progress').'') !!}
                        {!! Form::number('progress', old('progress'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('progress')){{ $errors->first('progress') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m4 s12">
                    <div class="input-field">
                        {!! Form::label('rating', trans('global.datatrail.fields.rating').'') !!}
                        {!! Form::number('rating', old('rating'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('rating')){{ $errors->first('rating') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col s12">
                    <div class="input-field">
                        {!! Form::label('testimonal', trans('global.datatrail.fields.testimonal').'') !!}
                        {!! Form::textarea('testimonal', old('testimonal'), ['class' => 'materialize-textarea ', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('testimonal')){{ $errors->first('testimonal') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m4 s12">
                    {!! Form::label('user_id', trans('global.datatrail.fields.user').'') !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('user_id')){{ $errors->first('user_id') }}@endif" data-success="right"></span>
                </div>

                <div class="col m4 s12">
                    {!! Form::label('trail_id', trans('global.datatrail.fields.trail').'') !!}
                    {!! Form::select('trail_id', $trails, old('trail_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('trail_id')){{ $errors->first('trail_id') }}@endif" data-success="right"></span>
                </div>

                <div class="col m4 s12">
                    {!! Form::label('certificate_id', trans('global.datatrail.fields.certificate').'') !!}
                    {!! Form::select('certificate_id', $certificates, old('certificate_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('certificate_id')){{ $errors->first('certificate_id') }}@endif" data-success="right"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            {!! Form::button(trans('global.app_create') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@stop

