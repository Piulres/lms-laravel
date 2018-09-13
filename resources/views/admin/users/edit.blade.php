@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.users.title')</h4>
    </div>
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-content">
            <div class="title col-md-12">
                <h5>@lang('global.app_edit')</h5>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('name', trans('global.users.fields.name').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('name'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('last_name', trans('global.users.fields.last-name').'', ['class' => 'control-label']) !!}
                        {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('last_name'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('last_name') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('email', trans('global.users.fields.email').'*', ['class' => 'control-label']) !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('email'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('website', trans('global.users.fields.website').'', ['class' => 'control-label']) !!}
                        {!! Form::text('website', old('website'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                <div class="col-12 col-md-6">
                    <div class="file-field input-field">
                        @if ($user->avatar)
                            <a href="{{ asset(env('UPLOAD_PATH').'/'.$user->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$user->avatar) }}"></a>
                        @endif
                        <div class="btn">
                            <span>File</span>
                            {!! Form::file('avatar', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
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

                <div class="col-12 col-md-6">
                    {!! Form::label('password', trans('global.users.fields.password').'*', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('password'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="col-12 no-padding">
                        {!! Form::label('role', trans('global.users.fields.role').'*', ['class' => 'control-label']) !!}
                        {!! Form::select('role[]', $roles, old('role') ? old('role') : $user->role->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-role' , 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('role'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('role') }}
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="waves-effect waves-light btn-small" id="selectbtn-role">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="waves-effect waves-light btn-small" id="deselectbtn-role">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('team_id', trans('global.users.fields.team').'', ['class' => 'control-label']) !!}
                    {!! Form::select('team_id', $teams, old('team_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('team_id'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('team_id') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label>
                    <!-- {!! Form::label('approved', trans('global.users.fields.approved').'', ['class' => 'control-label']) !!} -->
                    {!! Form::hidden('approved', 0) !!}
                    {!! Form::checkbox('approved', 1, old('approved', old('approved')), []) !!}
                    <span>
                        Approved
                    </span>
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('approved'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('approved') }}
                        </span>
                    @endif
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!} -->
    {!! Form::button('<i class="material-icons right">send</i>Update', ['class'=>'btn waves-effect waves-light', 'type'=>'submit']) !!}
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