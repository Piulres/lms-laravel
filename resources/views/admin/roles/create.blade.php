@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.roles.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            @lang('global.roles.title')</a>
                    </li> /
                    <li><span>@lang('global.app_create')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.roles.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>


    {!! Form::open(['method' => 'POST', 'route' => ['admin.roles.store']]) !!}
    <div class="card">
        <div class="title">
            <h5>@lang('global.app_create')</h5>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col m6 s12">
                    {!! Form::label('title', trans('global.roles.fields.title').'*') !!}
                    {!! Form::text('title', old('title'), ['class' => 'validate', 'required' => '']) !!}
                    <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                </div>
            </div>
            <div class="row">

                <div class="col m6 s12">
                    <div class="col s12" style="position:relative;">
                        {!! Form::label('permission', trans('global.roles.fields.permission').'*') !!}
                        {!! Form::select('permission[]', $permissions, old('permission'), ['class' => 'select2', 'multiple' => 'multiple', 'id' => 'selectall-permission' , 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('permission')){{ $errors->first('permission') }}@endif" data-success="right"></span>
                    </div>
                    <div class="btn-group col s12">
                        <button type="button" class="btn btn-small btn-rounded" id="selectbtn-permission">
                            {{ trans('global.app_select_all') }}
                        </button>
                        <button type="button" class="btn btn-small btn-rounded" id="deselectbtn-permission">
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
        $("#selectbtn-permission").click(function(){
            $("#selectall-permission > option").prop("selected","selected");
            $("#selectall-permission").trigger("change");
        });
        $("#deselectbtn-permission").click(function(){
            $("#selectall-permission > option").prop("selected","");
            $("#selectall-permission").trigger("change");
        });
    </script>
@stop