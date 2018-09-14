@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.datatrails.title')</h4>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.datatrails.store']]) !!}

    <div class="card">
        
        <div class="card-content">
            <div class="title col-12">
                @lang('global.app_create')
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('trail_id', trans('global.datatrails.fields.trail').'', ['class' => 'control-label']) !!}
                    {!! Form::select('trail_id', $trails, old('trail_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('trail_id'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('trail_id') }}
                        </span>
                    @endif
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('user_id', trans('global.datatrails.fields.user').'', ['class' => 'control-label']) !!}
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
                    <div class="input-field">
                        {!! Form::label('progress', trans('global.datatrails.fields.progress').'', ['class' => 'control-label']) !!}
                        {!! Form::number('progress', old('progress'), ['class' => 'form-control']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('progress'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('progress') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('rating', trans('global.datatrails.fields.rating').'', ['class' => 'control-label']) !!}
                        {!! Form::number('rating', old('rating'), ['class' => 'form-control']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('rating'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('rating') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label for="view">
                        {!! Form::hidden('view', 0) !!}
                        {!! Form::checkbox('view', 1, old('view', false), []) !!}
                        <span>@lang('global.datatrails.fields.view')</span>
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

    {!! Form::button('<i class="material-icons right">send</i>Create', ['class'=>'btn waves-effect waves-light grey', 'type'=>'submit']) !!}
    {!! Form::close() !!}
@stop

