@extends('layouts.app')

@section('content')
<div class="header-title">
    <h2>@lang('global.teams.title')</h2>
</div>    
    {!! Form::model($team, ['method' => 'PUT', 'route' => ['admin.teams.update', $team->id]]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('name', trans('global.teams.fields.name').'*') !!}
                    {!! Form::text('name', old('name'), ['class' => 'validate', 'required' => '']) !!}
                    <span class="helper-text" data-error="@if($errors->has('name')){{ $errors->first('name') }}@endif" data-success="right"></span>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
    {!! Form::close() !!}
@stop

