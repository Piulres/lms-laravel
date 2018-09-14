@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.trails.title')</h4>
    </div>
    
    {!! Form::model($trail, ['method' => 'PUT', 'route' => ['admin.trails.update', $trail->id]]) !!}

    <div class="card">

        <div class="card-content">
            <div class="title col-12">
                <h5>@lang('global.app_edit')</h5>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.trails.fields.title').'', ['class' => 'control-label']) !!}
                        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
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
                    <div class="col-12 no-padding">
                        {!! Form::label('categories', trans('global.trails.fields.categories').'', ['class' => 'control-label']) !!}
                        {!! Form::select('categories[]', $categories, old('categories') ? old('categories') : $trail->categories->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-categories' ]) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('categories'))
                            <p class="help-block">
                                {{ $errors->first('categories') }}
                            </p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-categories">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-categories">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="col-12 no-padding">
                        {!! Form::label('courses', trans('global.trails.fields.courses').'', ['class' => 'control-label']) !!}
                        {!! Form::select('courses[]', $courses, old('courses') ? old('courses') : $trail->courses->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-courses' ]) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('courses'))
                            <p class="help-block">
                                {{ $errors->first('courses') }}
                            </p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-courses">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-courses">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::button('<i class="material-icons right">send</i>Update', ['class'=>'btn waves-effect waves-light grey', 'type'=>'submit']) !!}
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