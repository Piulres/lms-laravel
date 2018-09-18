@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.courses.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.courses.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('order', trans('global.courses.fields.order').'', ['class' => 'control-label']) !!}
                    {!! Form::number('order', old('order'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('order'))
                        <p class="help-block">
                            {{ $errors->first('order') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.courses.fields.title').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('slug', trans('global.courses.fields.slug').'', ['class' => 'control-label']) !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('slug'))
                        <p class="help-block">
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.courses.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('introduction', trans('global.courses.fields.introduction').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('introduction', old('introduction'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('introduction'))
                        <p class="help-block">
                            {{ $errors->first('introduction') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('featured_image', trans('global.courses.fields.featured-image').'', ['class' => 'control-label']) !!}
                    {!! Form::file('featured_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('featured_image_max_size', 4) !!}
                    {!! Form::hidden('featured_image_max_width', 4096) !!}
                    {!! Form::hidden('featured_image_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('featured_image'))
                        <p class="help-block">
                            {{ $errors->first('featured_image') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('instructor', trans('global.courses.fields.instructor').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-instructor">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-instructor">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('instructor[]', $instructors, old('instructor'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-instructor' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('instructor'))
                        <p class="help-block">
                            {{ $errors->first('instructor') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('lessons', trans('global.courses.fields.lessons').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-lessons">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-lessons">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('lessons[]', $lessons, old('lessons'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-lessons' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lessons'))
                        <p class="help-block">
                            {{ $errors->first('lessons') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('duration', trans('global.courses.fields.duration').'', ['class' => 'control-label']) !!}
                    {!! Form::number('duration', old('duration'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('duration'))
                        <p class="help-block">
                            {{ $errors->first('duration') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start_date', trans('global.courses.fields.start-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_date'))
                        <p class="help-block">
                            {{ $errors->first('start_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('end_date', trans('global.courses.fields.end-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('categories', trans('global.courses.fields.categories').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-categories">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-categories">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('categories[]', $categories, old('categories'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-categories' ]) !!}
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
                    {!! Form::label('tags', trans('global.courses.fields.tags').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-tags">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-tags">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('tags[]', $tags, old('tags'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-tags' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('tags'))
                        <p class="help-block">
                            {{ $errors->first('tags') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('approved', trans('global.courses.fields.approved').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('approved', 0) !!}
                    {!! Form::checkbox('approved', 1, old('approved', false), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('approved'))
                        <p class="help-block">
                            {{ $errors->first('approved') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
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