@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.datacourses.title')</h3>
    
    {!! Form::model($datacourse, ['method' => 'PUT', 'route' => ['admin.datacourses.update', $datacourse->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('course_id', trans('global.datacourses.fields.course').'', ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('course_id'))
                        <p class="help-block">
                            {{ $errors->first('course_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('global.datacourses.fields.user').'', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('view', trans('global.datacourses.fields.view').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('view', 0) !!}
                    {!! Form::checkbox('view', 1, old('view', old('view')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('view'))
                        <p class="help-block">
                            {{ $errors->first('view') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('progress', trans('global.datacourses.fields.progress').'', ['class' => 'control-label']) !!}
                    {!! Form::number('progress', old('progress'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('progress'))
                        <p class="help-block">
                            {{ $errors->first('progress') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('rating', trans('global.datacourses.fields.rating').'', ['class' => 'control-label']) !!}
                    {!! Form::number('rating', old('rating'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('rating'))
                        <p class="help-block">
                            {{ $errors->first('rating') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

