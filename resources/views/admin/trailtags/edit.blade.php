@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.trailtags.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.trailtags.title')</h2>
    </div>
    
    {!! Form::model($trailtag, ['method' => 'PUT', 'route' => ['admin.trailtags.update', $trailtag->id]]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.trailtags.fields.title').'') !!}
                        {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('slug', trans('global.trailtags.fields.slug').'') !!}
                        {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
    {!! Form::close() !!}
@stop

