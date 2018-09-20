@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.permissions.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.permissions.title')</h2>
    </div>

    {!! Form::model($permission, ['method' => 'PUT', 'route' => ['admin.permissions.update', $permission->id]]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('title', trans('global.permissions.fields.title').'*') !!}
                    {!! Form::text('title', old('title'), ['class' => 'validate', 'required' => '']) !!}
                    <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
    {!! Form::close() !!}
@stop

