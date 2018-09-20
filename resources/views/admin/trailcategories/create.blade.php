@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.trailcategories.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.trailcategories.title')</h2>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.trailcategories.store']]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_create')</h3>
        </div>
        
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('title', trans('global.trailcategories.fields.title').'') !!}
                    {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                    <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('slug', trans('global.trailcategories.fields.slug').'') !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                    <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light grey']) !!}
    {!! Form::close() !!}
@stop

