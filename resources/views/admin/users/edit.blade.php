@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.users.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            @lang('global.users.title')</a>
                    </li> /
                    <li><span>@lang('global.app_edit')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.users.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>


    {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id], 'files' => true,]) !!}
    <div class="card">
        <div class="title">
            <h5>@lang('global.app_edit')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col m4 s12">
                    <div class="input-field">
                        {!! Form::label('name', trans('global.users.fields.name').'*') !!}
                        {!! Form::text('name', old('name'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('name')){{ $errors->first('name') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m4 s12">
                    <div class="input-field">
                        {!! Form::label('lastname', trans('global.users.fields.lastname').'') !!}
                        {!! Form::text('lastname', old('lastname'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('lastname')){{ $errors->first('lastname') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m4 s12">
                    <div class="input-field">
                        {!! Form::label('email', trans('global.users.fields.email').'*') !!}
                        {!! Form::email('email', old('email'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('email')){{ $errors->first('email') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m4 s12">
                    <div class="input-field">
                        {!! Form::label('website', trans('global.users.fields.website').'') !!}
                        {!! Form::text('website', old('website'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('website')){{ $errors->first('website') }}@endif" data-success="right"></span>
                    </div>
                </div>


                <div class="col m4 s12">
                    <div class="input-field">
                        {!! Form::label('password', trans('global.users.fields.password').'*') !!}
                        {!! Form::password('password', ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('password')){{ $errors->first('password') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m4 s12">
                    <div class="file-field input-field">
                        <div class="btn grey">
                            <span>File</span>
                            {!! Form::file('avatar') !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your avatar']) !!}
                        </div>
                        {!! Form::hidden('avatar_max_size', 2) !!}
                        {!! Form::hidden('avatar_max_width', 4096) !!}
                        {!! Form::hidden('avatar_max_height', 4096) !!}
                        <span class="helper-text" data-error="@if($errors->has('avatar')){{ $errors->first('avatar') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col m6 s12">
                    <div class="col s12" style="position: relative;">
                        {!! Form::label('role', trans('global.users.fields.role').'*') !!}
                        {!! Form::select('role[]', $roles, old('role'), ['class' => 'select2', 'multiple' => 'multiple', 'id' => 'selectall-role' , 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('role')){{ $errors->first('role') }}@endif" data-success="right"></span>
                    </div>
                    <div class="btn-group col l12">
                        <button type="button" class="btn btn-small btn-rounded" id="selectbtn-role">
                            {{ trans('global.app_select_all') }}
                        </button>
                        <button type="button" class="btn btn-small btn-rounded" id="deselectbtn-role">
                            {{ trans('global.app_deselect_all') }}
                        </button>
                    </div>
                </div>

                <div class="col m6 s12">
                    {!! Form::label('team_id', trans('global.users.fields.team').'') !!}
                    {!! Form::select('team_id', $teams, old('team_id'), ['label' => 'Please Select']) !!}
                    <span class="helper-text" data-error="@if($errors->has('team_id')){$errors->first('approved') }}@endif" data-success="right"></span>
                </div>

                <div class="col s12">
                    {!! Form::hidden('approved', 0) !!}
                    {!! Form::checkbox('approved', 1, old('approved'), ['id' => 'approved']) !!}
                    {!! Form::label('approved', trans('global.users.fields.approved').'') !!}
                    <span class="helper-text" data-error="@if($errors->has('approved')){$errors->first('approved') }}@endif" data-success="right"></span>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col s12">
            {!! Form::button(trans('global.app_update') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
        </div>
    </div>
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