@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.teams.title')</h4>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.teams.store']]) !!}

    <div class="card">
        
        <div class="card-content">
            <div class="title col-12">
                <h5>@lang('global.app_create')</h5>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('name', trans('global.teams.fields.name').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::button('<i class="material-icons right">send</i>Submit', ['class'=>'btn waves-effect waves-light grey', 'type'=>'submit']) !!}
    {!! Form::close() !!}
@stop

