@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.trailtags.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li><span>@lang('global.trailtags.title')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">

                @can('trailtag_create')
                    <a href="{{ route('admin.trailtags.create') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        Add Trail
                    </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="back-button">
        <a href="{{ route('admin.trailtags.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.trailtags.title')</h2>
    </div>


    <div class="card">
        {!! Form::model($trailtag, ['method' => 'PUT', 'route' => ['admin.trailtags.update', $trailtag->id]]) !!}
        <div class="title">
            <h5>@lang('global.app_edit')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.trailtags.fields.title').'') !!}
                        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                        <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('slug', trans('global.trailtags.fields.slug').'') !!}
                        {!! Form::text('slug', old('slug'), ['class' => 'form-control']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>
            </div>

            {!! Form::button('<i class="material-icons right">send</i>Create', ['class'=>'btn waves-effect waves-light', 'type'=>'submit']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop

