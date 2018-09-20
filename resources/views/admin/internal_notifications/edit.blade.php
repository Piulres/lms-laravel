@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.internal_notifications.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.internal-notifications.title')</h2>
    </div>    
    {!! Form::model($internal_notification, ['method' => 'PUT', 'route' => ['admin.internal_notifications.update', $internal_notification->id]]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('text', trans('global.internal-notifications.fields.text').'*') !!}
                        {!! Form::text('text', old('text'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('text')){{ $errors->first('text') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('link', trans('global.internal-notifications.fields.link').'') !!}
                        {!! Form::text('link', old('link'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('link')){{ $errors->first('link') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('users', trans('global.internal-notifications.fields.users').'*') !!}
                            {!! Form::select('users[]', $users, old('users'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-users' , 'required' => '']) !!}
                            <span class="helper-text" data-error="@if($errors->has('users')){{ $errors->first('users') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-users">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-users">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
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