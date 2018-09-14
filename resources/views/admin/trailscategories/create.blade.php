@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.trailscategories.title')</h4>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.trailscategories.store']]) !!}

    <div class="card">
        
        <div class="card-content">
            <div class="title col-12">
                <h5>@lang('global.app_create')</h5>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.trailscategories.fields.title').'', ['class' => 'control-label']) !!}
                        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('title'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('title') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::button('<i class="material-icons right">send</i>Create', ['class'=>'btn waves-effect waves-light grey', 'type'=>'submit']) !!}
    {!! Form::close() !!}
@stop

