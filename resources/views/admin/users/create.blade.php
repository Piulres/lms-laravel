@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.users.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-content">
            <div class="card-title col-md-12">
                <h5>@lang('global.app_create')</h5>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <div class="input-field">
                        {!! Form::label('name', trans('global.users.fields.name').'*') !!}
                        {!! Form::text('name', old('name'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('name'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="input-field">
                        {!! Form::label('last_name', trans('global.users.fields.last-name').'') !!}
                        {!! Form::text('last_name', old('last_name'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('last_name'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <div class="input-field">
                        {!! Form::label('email', trans('global.users.fields.email').'*') !!}
                        {!! Form::email('email', old('email'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('email'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="input-field">
                        {!! Form::label('website', trans('global.users.fields.website').'') !!}
                        {!! Form::text('website', old('website'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('website'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('website') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            {!! Form::file('hidden') !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your avatar']) !!}
                        </div>
                        {!! Form::hidden('avatar_max_size', 2) !!}
                        {!! Form::hidden('avatar_max_width', 4096) !!}
                        {!! Form::hidden('avatar_max_height', 4096) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('avatar'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('avatar') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="input-field">
                        {!! Form::label('password', trans('global.users.fields.password').'*') !!}
                        {!! Form::password('password', ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('password'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <!-- {!! Form::label('role', trans('global.users.fields.role').'*', ['class' => 'control-label']) !!} -->
                    <button type="button" class="waves-effect waves-light btn-small" id="selectbtn-role">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="waves-effect waves-light btn-small" id="deselectbtn-role">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('role[]', $roles, old('role'), ['multiple' => 'multiple', 'id' => 'selectall-role' , 'required' => '']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('role'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('role') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="input-field">
                        <!-- {!! Form::label('team_id', trans('global.users.fields.team').'', ['class' => 'control-label']) !!} -->
                        {!! Form::select('team_id', $teams, old('team_id'), ['label' => 'Please Select']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('team_id'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('team_id') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('approved', trans('global.users.fields.approved').'', ['class' => 'control-label']) !!}
                        {!! Form::hidden('approved', 0) !!}
                        {!! Form::checkbox('approved', 1, old('approved', false), []) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('approved'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('approved') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::button('<i class="material-icons right">send</i>Submit', ['class'=>'btn waves-effect waves-light', 'type'=>'submit']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-role").click(function(){
            $("#selectall-role > option").prop("selected","selected");
            $("#selectall-role").trigger("change");
        });
        $("#deselectbtn-role").click(function(){
            $("#selectall-role > option").prop("selected","");
            $("#selectall-role").trigger("change");
        });
    </script>
@stop