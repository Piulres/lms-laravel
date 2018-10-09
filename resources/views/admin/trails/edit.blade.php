@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.trails.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.trails.index') }}">
                            @lang('global.trails.title')</a>
                    </li> /
                    <li><span>@lang('global.app_editor')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.trails.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    {!! Form::model($trail, ['method' => 'PUT', 'route' => ['admin.trails.update', $trail->id]]) !!}
    <div class="row">
        <div class="col l9 m8 s12">
            <div class="card">
                <div class="title">
                    <h5>@lang('global.app_edit')</h5>
                </div>

                <div class="content">
                    <div class="row">

                        <div class="col m7 s12">
                            <div class="input-field">
                                {!! Form::label('title', trans('global.trails.fields.title').'') !!}
                                {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                                <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                            </div>
                        </div>

                        <div class="col m5 s12">
                            {!! Form::label('featured_image', trans('global.trails.fields.featured-image').'') !!}
                            {!! Form::text('featured_image', old('featured_image'), ['class' => 'validate']) !!}
                            <span class="helper-text" data-error="@if($errors->has('featured_image')){{ $errors->first('featured_image') }}@endif" data-success="right"></span>
                        </div>

                        <div class="col s12">
                            <div class="input-field">
                                {!! Form::label('description', trans('global.trails.fields.description').'') !!}
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control materialize-textarea', 'placeholder' => '']) !!}
                                <span class="helper-text" data-error="@if($errors->has('description')){{ $errors->first('description') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m4 s12">
                            <div class="col s12" style="position: relative;">
                                {!! Form::label('courses', trans('global.trails.fields.courses').'') !!}
                                {!! Form::select('courses[]', $courses, old('courses'), ['class' => 'select2', 'multiple' => 'multiple', 'id' => 'selectall-courses' ]) !!}
                                <span class="helper-text" data-error="@if($errors->has('courses')){{ $errors->first('courses') }}@endif" data-success="right"></span>
                            </div>
                            <div class="btn-group col l12">
                                <button type="button" class="btn btn-small btn-rounded" id="selectbtn-courses">
                                    {{ trans('global.app_select_all') }}
                                </button>
                                <button type="button" class="btn btn-small btn-rounded" id="deselectbtn-courses">
                                    {{ trans('global.app_deselect_all') }}
                                </button>
                            </div>
                        </div>

                        <div class="col m4 s12">
                            <div class="col s12" style="position: relative;">
                                {!! Form::label('categories', trans('global.trails.fields.categories').'') !!}
                                {!! Form::select('categories[]', $categories, old('categories'), ['class' => 'select2', 'multiple' => 'multiple', 'id' => 'selectall-categories' ]) !!}
                                <span class="helper-text" data-error="@if($errors->has('categories')){{ $errors->first('categories') }}@endif" data-success="right"></span>
                            </div>
                            <div class="btn-group col l12">
                                <button type="button" class="btn btn-small btn-rounded" id="selectbtn-categories">
                                    {{ trans('global.app_select_all') }}
                                </button>
                                <button type="button" class="btn btn-small btn-rounded" id="deselectbtn-categories">
                                    {{ trans('global.app_deselect_all') }}
                                </button>
                            </div>
                        </div>

                        <div class="col m4 s12">
                            <div class="col s12" style="position: relative;">
                                {!! Form::label('tags', trans('global.trails.fields.tags').'') !!}
                                {!! Form::select('tags[]', $tags, old('tags'), ['class' => 'select2', 'multiple' => 'multiple', 'id' => 'selectall-tags' ]) !!}
                                <span class="helper-text" data-error="@if($errors->has('tags')){{ $errors->first('tags') }}@endif" data-success="right"></span>
                            </div>
                            <div class="btn-group col l12">
                                <button type="button" class="btn btn-small btn-rounded" id="selectbtn-tags">
                                    {{ trans('global.app_select_all') }}
                                </button>
                                <button type="button" class="btn btn-small btn-rounded" id="deselectbtn-tags">
                                    {{ trans('global.app_deselect_all') }}
                                </button>
                            </div>
                        </div>

                        <div class="col s12">
                            {!! Form::label('introduction', trans('global.trails.fields.introduction').'') !!}
                            {!! Form::textarea('introduction', old('introduction'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                            <span class="helper-text" data-error="@if($errors->has('introduction')){{ $errors->first('introduction') }}@endif" data-success="right"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m4 s12">
            <div class="card">
                <div class="title">
                    <h5>Informations</h5>
                    <a class="minimize" href="#" draggable="false"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col s6">
                            <div class="input-field">
                                {!! Form::label('order', trans('global.trails.fields.order').'') !!}
                                {!! Form::text('order', old('order'), ['class' => 'validate']) !!}
                                <span class="helper-text" data-error="@if($errors->has('order')){{ $errors->first('order') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="input-field">
                                {!! Form::label('slug', trans('global.trails.fields.slug').'') !!}
                                {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                                <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="input-field">
                                {!! Form::label('start_date', trans('global.trails.fields.start-date').'') !!}
                                {!! Form::text('start_date', old('start_date'), ['class' => 'datepicker']) !!}
                                <span class="helper-text" data-error="@if($errors->has('start_date')){{ $errors->first('start_date') }}@endif" data-success="right"></span>
                            </div>
                        </div>

                        <div class="col s6">
                            <div class="input-field">
                                {!! Form::label('end_date', trans('global.trails.fields.end-date').'') !!}
                                {!! Form::text('end_date', old('end_date'), ['class' => 'datepicker']) !!}
                                <span class="helper-text" data-error="@if($errors->has('end_date')){{ $errors->first('end_date') }}@endif" data-success="right"></span>
                            </div>
                        </div>

                        <div class="col s12">
                            {!! Form::hidden('approved', 0) !!}
                            {!! Form::checkbox('approved', 1, old('approved'), ['id' => 'approved']) !!}
                            {!! Form::label('approved', trans('global.users.fields.approved').'') !!}
                            <span class="helper-text" data-error="@if($errors->has('approved')){{ $errors->first('approved') }}@endif" data-success="right"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    {!! Form::button(trans('global.app_create') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
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
        $("#selectbtn-courses").click(function(){
            $("#selectall-courses > option").prop("selected","selected");
            $("#selectall-courses").trigger("change");
        });
        $("#deselectbtn-courses").click(function(){
            $("#selectall-courses > option").prop("selected","");
            $("#selectall-courses").trigger("change");
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