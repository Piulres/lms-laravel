@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.trails.title')</h4>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.trails.store']]) !!}

    <div class="card">
        <div class="card-content">
            <div class="panel-heading">
                <h5>@lang('global.app_create')</h5>
            </div>
        
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('title', trans('global.trails.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="col-12 no-padding">
                        {!! Form::label('categories', trans('global.trails.fields.categories').'') !!}
                        {!! Form::select('categories[]', $categories, old('categories'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-categories' ]) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('categories'))
                            <p class="help-block">
                                {{ $errors->first('categories') }}
                            </p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="waves-effect waves-light btn-small" id="selectbtn-categories">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="waves-effect waves-light btn-small" id="deselectbtn-categories">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="col-12 no-padding">
                        {!! Form::label('courses', trans('global.trails.fields.courses').'') !!}
                        {!! Form::select('courses[]', $courses, old('courses'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-courses' ]) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('courses'))
                            <p class="help-block">
                                {{ $errors->first('courses') }}
                            </p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="waves-effect waves-light btn-small" id="selectbtn-courses">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="waves-effect waves-light btn-small" id="deselectbtn-courses">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
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