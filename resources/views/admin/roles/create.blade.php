@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.roles.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.roles.title')</h2>
    </div>

    {!! Form::open(['method' => 'POST', 'route' => ['admin.roles.store']]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_create')</h3>
        </div>
        
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('title', trans('global.roles.fields.title').'*') !!}
                    {!! Form::text('title', old('title'), ['class' => 'validate', 'required' => '']) !!}
                    <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('permission', trans('global.roles.fields.permission').'*') !!}
                            {!! Form::select('permission[]', $permissions, old('permission'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-permission' , 'required' => '']) !!}
                            <span class="helper-text" data-error="@if($errors->has('permission')){{ $errors->first('permission') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-permission">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-permission">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light grey']) !!}
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