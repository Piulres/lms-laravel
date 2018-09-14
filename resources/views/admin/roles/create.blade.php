@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.roles.title')</h4>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.roles.store']]) !!}

    <div class="card">
        
        <div class="card-content">
            <div class="title col-md-12">
                <h5>@lang('global.app_create')</h5>
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.roles.fields.title').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('title', old('title'), ['class' => 'form-control', 'required' => '']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('title'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('title') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('permission', trans('global.roles.fields.permission').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('permission[]', $permissions, old('permission'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-permission' , 'required' => '']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('permission'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('permission') }}
                        </span>
                    @endif
                    <div class="row">
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

    {!! Form::button('<i class="material-icons right">send</i>Save', ['class'=>'btn waves-effect waves-light grey', 'type'=>'submit']) !!}
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