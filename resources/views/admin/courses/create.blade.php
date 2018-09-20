@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.courses.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.courses.title')</h2>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.courses.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_create')</h3>
        </div>
        
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('order', trans('global.courses.fields.order').'') !!}
                        {!! Form::number('order', old('order'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('order')){{ $errors->first('order') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.courses.fields.title').'') !!}
                        {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('slug', trans('global.courses.fields.slug').'') !!}
                        {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('description', trans('global.courses.fields.description').'') !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'materialize-textarea ', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('description')){{ $errors->first('description') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="file-field input-field">
                        <div class="btn grey">
                            <span>File</span>
                            {!! Form::file('featured_image') !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your avatar']) !!}
                        </div>
                        {!! Form::hidden('featured_image_max_size', 4) !!}
                        {!! Form::hidden('featured_image_max_width', 4096) !!}
                        {!! Form::hidden('featured_image_max_height', 4096) !!}
                    </div>
                    <span class="helper-text" data-error="@if($errors->has('featured_image')){{ $errors->first('featured_image') }}@endif" data-success="right"></span>
                    @if ($course->featured_image)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$course->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$course->featured_image) }}"></a>
                    @endif
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('instructor', trans('global.courses.fields.instructor').'') !!}
                            {!! Form::select('instructor[]', $instructors, old('instructor'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-instructor' ]) !!}
                            <span class="helper-text" data-error="@if($errors->has('instructor')){{ $errors->first('instructor') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-instructor">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-instructor">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('lessons', trans('global.courses.fields.lessons').'') !!}
                            {!! Form::select('lessons[]', $lessons, old('lessons'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-lessons' ]) !!}
                            <span class="helper-text" data-error="@if($errors->has('lessons')){{ $errors->first('lessons') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-lessons">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-lessons">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('duration', trans('global.courses.fields.duration').'') !!}
                        {!! Form::number('duration', old('duration'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('duration')){{ $errors->first('duration') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('start_date', trans('global.courses.fields.start-date').'') !!}
                        {!! Form::text('start_date', old('start_date'), ['class' => 'form-control datepicker']) !!}
                        <span class="helper-text" data-error="@if($errors->has('start_date')){{ $errors->first('start_date') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('end_date', trans('global.courses.fields.end-date').'') !!}
                        {!! Form::text('end_date', old('end_date'), ['class' => 'form-control datepicker']) !!}
                        <span class="helper-text" data-error="@if($errors->has('end_date')){{ $errors->first('end_date') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('categories', trans('global.courses.fields.categories').'') !!}
                            {!! Form::select('categories[]', $categories, old('categories'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-categories' ]) !!}
                            <span class="helper-text" data-error="@if($errors->has('categories')){{ $errors->first('categories') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-categories">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-categories">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('tags', trans('global.courses.fields.tags').'') !!}
                            {!! Form::select('tags[]', $tags, old('tags'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-tags' ]) !!}
                            <span class="helper-text" data-error="@if($errors->has('tags')){{ $errors->first('tags') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-tags">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-tags">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <label for="approved">
                            <!-- {!! Form::label('approved', trans('global.courses.fields.approved').'') !!} -->
                            <!-- {!! Form::hidden('approved', 0) !!} -->
                            {!! Form::checkbox('approved', 1, old('approved', false), []) !!}
                            <span>@lang('global.courses.fields.approved')</span>
                        </label>
                        <span class="helper-text" data-error="@if($errors->has('approved')){{ $errors->first('approved') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-12">
                    <div class="input-field">
                        {!! Form::label('introduction', trans('global.courses.fields.introduction').'') !!}
                        {!! Form::textarea('introduction', old('introduction'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('introduction')){{ $errors->first('introduction') }}@endif" data-success="right"></span>
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

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
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

    <script>
        $("#selectbtn-tags").click(function(){
            $("#selectall-tags > option").prop("selected","selected");
            $("#selectall-tags").trigger("change");
        });
        $("#deselectbtn-tags").click(function(){
            $("#selectall-tags > option").prop("selected","");
            $("#selectall-tags").trigger("change");
        });
    </script>
@stop