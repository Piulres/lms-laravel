@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.trails.title')</h3>
    
    {!! Form::model($trail, ['method' => 'PUT', 'route' => ['admin.trails.update', $trail->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.trails.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('categories', trans('global.trails.fields.categories').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-categories">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-categories">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('categories[]', $categories, old('categories') ? old('categories') : $trail->categories->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-categories' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('categories'))
                        <p class="help-block">
                            {{ $errors->first('categories') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('courses', trans('global.trails.fields.courses').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-courses">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-courses">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('courses[]', $courses, old('courses') ? old('courses') : $trail->courses->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-courses' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('courses'))
                        <p class="help-block">
                            {{ $errors->first('courses') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-categories").click(function(){
            $("#selectall-categories > option").prop("selected","selected");
            $("#selectall-categories").trigger("change");
        });
        $("#deselectbtn-categories").click(function(){
            $("#selectall-categories > option").prop("selected","");
            $("#selectall-categories").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-courses").click(function(){
            $("#selectall-courses > option").prop("selected","selected");
            $("#selectall-courses").trigger("change");
        });
        $("#deselectbtn-courses").click(function(){
            $("#selectall-courses > option").prop("selected","");
            $("#selectall-courses").trigger("change");
        });
    </script>
@stop