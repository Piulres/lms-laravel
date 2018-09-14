@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.datacourses.title')</h4>
    </div>
    
    {!! Form::model($datacourse, ['method' => 'PUT', 'route' => ['admin.datacourses.update', $datacourse->id]]) !!}

    <div class="card">

        <div class="card-content">
            <div class="title col-12">
                @lang('global.app_edit')
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('course_id', trans('global.datacourses.fields.course').'', ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('course_id'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('course_id') }}
                        </span>
                    @endif
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('user_id', trans('global.datacourses.fields.user').'', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('user_id'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('user_id') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('progress', trans('global.datacourses.fields.progress').'', ['class' => 'control-label']) !!}
                    {!! Form::number('progress', old('progress'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('progress'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('progress') }}
                        </span>
                    @endif
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('rating', trans('global.datacourses.fields.rating').'', ['class' => 'control-label']) !!}
                    {!! Form::number('rating', old('rating'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('rating'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('rating') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label id="view">
                        {!! Form::hidden('view', 0) !!}
                        {!! Form::checkbox('view', 1, old('view', old('view')), []) !!}
                        <span>@lang('global.datacourses.fields.view')</span>
                    </label>
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('view'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('view') }}
                        </span>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::button('<i class="material-icons right">send</i>Update', ['class'=>'btn waves-effect waves-light', 'type'=>'submit']) !!}
    {!! Form::close() !!}
@stop

