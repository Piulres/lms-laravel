@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.users.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.users.title')</h2>
    </div>
    
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('name', trans('global.users.fields.name').'*') !!}
                        {!! Form::text('name', old('name'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('name')){{ $errors->first('name') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('lastname', trans('global.users.fields.lastname').'') !!}
                        {!! Form::text('lastname', old('lastname'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('lastname')){{ $errors->first('lastname') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('website', trans('global.users.fields.website').'') !!}
                        {!! Form::text('website', old('website'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('website')){{ $errors->first('website') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('email', trans('global.users.fields.email').'*') !!}
                        {!! Form::email('email', old('email'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('email')){{ $errors->first('email') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('password', trans('global.users.fields.password').'*') !!}
                        {!! Form::password('password', ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('password')){{ $errors->first('password') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="file-field input-field">
                        @if ($user->avatar)
                            <a href="{{ asset(env('UPLOAD_PATH').'/'.$user->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$user->avatar) }}"></a>
                        @endif
                        <div class="btn grey">
                            <span>File</span>
                            {!! Form::file('avatar', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your avatar']) !!}
                        </div>
                        {!! Form::hidden('avatar_max_size', 2) !!}
                        {!! Form::hidden('avatar_max_width', 4096) !!}
                        {!! Form::hidden('avatar_max_height', 4096) !!}
                        <span class="helper-text" data-error="@if($errors->has('avatar')){{ $errors->first('avatar') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('role', trans('global.users.fields.role').'*') !!}
                            {!! Form::select('role[]', $roles, old('role') ? old('role') : $user->role->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-role' , 'required' => '']) !!}
                            <span class="helper-text" data-error="@if($errors->has('role')){{ $errors->first('role') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-role">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-role">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('team_id', trans('global.users.fields.team').'') !!}
                    {!! Form::select('team_id', $teams, old('team_id'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="@if($errors->has('team_id')){{ $errors->first('team_id') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12">
                    <label>
                    <!-- {!! Form::label('approved', trans('global.users.fields.approved').'') !!} -->
                    {!! Form::hidden('approved', 0) !!}
                    {!! Form::checkbox('approved', 1, old('approved', old('approved')), []) !!}
                    <span>
                        @lang('global.trails.fields.approved')
                    </span>
                    <span class="helper-text" data-error="@if($errors->has('approved')){{ $errors->first('approved') }}@endif" data-success="right"></span>
                    </label>
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