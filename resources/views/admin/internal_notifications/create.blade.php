@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.internal-notifications.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.internal_notifications.index') }}">
                            @lang('global.internal-notifications.title')</a>
                    </li> /
                    <li><span>@lang('global.app_create')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.internal_notifications.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>


    {!! Form::open(['method' => 'POST', 'route' => ['admin.internal_notifications.store']]) !!}
    <div class="card">
        <div class="title">
            <h5>@lang('global.app_create')</h5>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('text', trans('global.internal-notifications.fields.text').'*') !!}
                        {!! Form::text('text', old('text'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('text')){{ $errors->first('text') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="input-field">
                        {!! Form::label('link', trans('global.internal-notifications.fields.link').'') !!}
                        {!! Form::text('link', old('link'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('link')){{ $errors->first('link') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col s12">
                    <div class="col s12" style="position: relative;">
                        {!! Form::label('users', trans('global.internal-notifications.fields.users').'*') !!}
                        {!! Form::select('users[]', $users, old('users'), ['class' => 'select2', 'multiple' => 'multiple', 'id' => 'selectall-users' , 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('users')){{ $errors->first('users') }}@endif" data-success="right"></span>
                    </div>
                    <div class="btn-group col l12">
                        <button type="button" class="btn btn-small btn-rounded" id="selectbtn-users">
                            {{ trans('global.app_select_all') }}
                        </button>
                        <button type="button" class="btn btn-small btn-rounded" id="deselectbtn-users">
                            {{ trans('global.app_deselect_all') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            {!! Form::button(trans('global.app_create') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-users").click(function(){
            $("#selectall-users > option").prop("selected","selected");
            $("#selectall-users").trigger("change");
        });
        $("#deselectbtn-users").click(function(){
            $("#selectall-users > option").prop("selected","");
            $("#selectall-users").trigger("change");
        });
    </script>
@stop