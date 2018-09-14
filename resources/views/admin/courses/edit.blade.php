@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.courses.title')</h4>
    </div>
    
    {!! Form::model($course, ['method' => 'PUT', 'route' => ['admin.courses.update', $course->id], 'files' => true,]) !!}

    <div class="card">

        <div class="card-content">
            <div class="row">
                <div class="title col-md-12">
                    <h5>@lang('global.app_edit')</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.courses.fields.title').'', ['class' => 'control-label']) !!}
                        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('title'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('title') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="col-12 no-padding">
                        {!! Form::label('instructor', trans('global.courses.fields.instructor').'', ['class' => 'control-label']) !!}
                        {!! Form::select('instructor[]', $instructors, old('instructor') ? old('instructor') : $course->instructor->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-instructor' ]) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('instructor'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('instructor') }}
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-xs" id="selectbtn-instructor">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-instructor">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="col-12 no-padding">
                        {!! Form::label('lessons', trans('global.courses.fields.lessons').'', ['class' => 'control-label']) !!}
                        {!! Form::select('lessons[]', $lessons, old('lessons') ? old('lessons') : $course->lessons->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-lessons' ]) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('lessons'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('lessons') }}
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-xs" id="selectbtn-lessons">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-lessons">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="col-12 no-padding">
                        {!! Form::label('categories', trans('global.courses.fields.categories').'', ['class' => 'control-label']) !!}
                        {!! Form::select('categories[]', $categories, old('categories') ? old('categories') : $course->categories->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-categories' ]) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('categories'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('categories') }}
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-xs" id="selectbtn-categories">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-categories">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="file-field input-field">
                        <div class="row">
                        @if ($course->featured_image)
                            <a href="{{ asset(env('UPLOAD_PATH').'/'.$course->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$course->featured_image) }}"></a>
                        @endif
                        </div>
                        <div class="btn">
                            <span>File</span>
                            {!! Form::file('featured_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your avatar']) !!}
                        </div>
                        {!! Form::hidden('featured_image_max_size', 5) !!}
                        {!! Form::hidden('featured_image_max_width', 4096) !!}
                        {!! Form::hidden('featured_image_max_height', 4096) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('featured_image'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('featured_image') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('description', trans('global.courses.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('introduction', trans('global.courses.fields.introduction').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('introduction', old('introduction'), ['class' => 'form-control editor']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('introduction'))
                        <p class="help-block">
                            {{ $errors->first('introduction') }}
                        </p>
                    @endif
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('duration', trans('global.courses.fields.duration').'', ['class' => 'control-label']) !!}
                    {!! Form::number('duration', old('duration'), ['class' => 'form-control']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('duration'))
                        <p class="help-block">
                            {{ $errors->first('duration') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::button('<i class="material-icons right">send</i>Update', ['class'=>'btn waves-effect waves-light grey', 'type'=>'submit']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

    <script>
        $("#selectbtn-instructor").click(function(){
            $("#selectall-instructor > option").prop("selected","selected");
            $("#selectall-instructor").trigger("change");
        });
        $("#deselectbtn-instructor").click(function(){
            $("#selectall-instructor > option").prop("selected","");
            $("#selectall-instructor").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-lessons").click(function(){
            $("#selectall-lessons > option").prop("selected","selected");
            $("#selectall-lessons").trigger("change");
        });
        $("#deselectbtn-lessons").click(function(){
            $("#selectall-lessons > option").prop("selected","");
            $("#selectall-lessons").trigger("change");
        });
    </script>

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
@stop