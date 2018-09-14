@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.internal-notifications.title')</h4>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.internal_notifications.store']]) !!}

    <div class="card">
        <div class="card-content">
            <div class="title col-12">
                <h5>@lang('global.app_create')</h5>
            </div>
        
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('text', trans('global.internal-notifications.fields.text').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('text', old('text'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('text'))
                            <p class="help-block">
                                {{ $errors->first('text') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('link', trans('global.internal-notifications.fields.link').'', ['class' => 'control-label']) !!}
                        {!! Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('link'))
                            <p class="help-block">
                                {{ $errors->first('link') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-12 no-padding">
                        {!! Form::label('users', trans('global.internal-notifications.fields.users').'*', ['class' => 'control-label']) !!}
                        {!! Form::select('users[]', $users, old('users'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-users' , 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('users'))
                            <p class="help-block">
                                {{ $errors->first('users') }}
                            </p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-users">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-3 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-users">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::button('<i class="material-icons right">send</i>Save', ['class'=>'btn waves-effect waves-light grey', 'type'=>'submit']) !!}
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