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
                    <a href="{{ route('admin.trailtags.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                        @lang('global.app_back_to_list')
                    </a>
                @endcan
            </div>
        </div>
    </div>

    {!! Form::model($trailtag, ['method' => 'PUT', 'route' => ['admin.trailtags.update', $trailtag->id]]) !!}
    <div class="row">
        <div class="col l9 m8 s12">
            <div class="card">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m4 s12">
            <div class="card">
                <div class="title">
                    <h5>Informations</h5>
                    <a class="minimize" href="#" draggable="false"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col m6 s12">
                            <div class="input-field">
                                {!! Form::label('slug', trans('global.trailtags.fields.slug').'') !!}
                                {!! Form::text('slug', old('slug'), ['class' => 'form-control']) !!}
                                <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    {!! Form::button(trans('global.app_update') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

