@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.coursetags.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.coursetags.index') }}">
                            @lang('global.coursetags.title')</a>
                    </li> /
                    <li><span>@lang('global.app_create')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.coursetags.index') }}" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>


    <div class="card">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.coursetags.store']]) !!}
        <div class="title">
            <h5>@lang('global.app_create')</h5>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.coursetags.fields.title').'') !!}
                        {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('slug', trans('global.coursetags.fields.slug').'') !!}
                        {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>
            </div>

            {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light grey']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@stop

