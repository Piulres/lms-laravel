@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.trails.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.trails.title')</h2>
    </div>    
    {!! Form::model($trail, ['method' => 'PUT', 'route' => ['admin.trails.update', $trail->id]]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_edit')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('order', trans('global.trails.fields.order').'') !!}
                        {!! Form::text('order', old('order'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('order')){{ $errors->first('order') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.trails.fields.title').'') !!}
                        {!! Form::text('title', old('title'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('slug', trans('global.trails.fields.slug').'') !!}
                        {!! Form::text('slug', old('slug'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('slug')){{ $errors->first('slug') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('description', trans('global.trails.fields.description').'') !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control materialize-textarea', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('description')){{ $errors->first('description') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('featured_image', trans('global.trails.fields.featured-image').'') !!}
                    {!! Form::text('featured_image', old('featured_image'), ['class' => 'validate']) !!}
                    <span class="helper-text" data-error="@if($errors->has('featured_image')){{ $errors->first('featured_image') }}@endif" data-success="right"></span>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('courses', trans('global.trails.fields.courses').'') !!}
                            {!! Form::select('courses[]', $courses, old('courses'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-courses' ]) !!}
                            <span class="helper-text" data-error="@if($errors->has('courses')){{ $errors->first('courses') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-courses">
                            {{ trans('global.app_select_all') }}
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-courses">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('start_date', trans('global.trails.fields.start-date').'') !!}
                        {!! Form::text('start_date', old('start_date'), ['class' => 'form-control datepicker']) !!}
                        <span class="helper-text" data-error="@if($errors->has('start_date')){{ $errors->first('start_date') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('end_date', trans('global.trails.fields.end-date').'') !!}
                        {!! Form::text('end_date', old('end_date'), ['class' => 'form-control datepicker']) !!}
                        <span class="helper-text" data-error="@if($errors->has('end_date')){{ $errors->first('end_date') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('categories', trans('global.trails.fields.categories').'') !!}
                            {!! Form::select('categories[]', $categories, old('categories'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-categories' ]) !!}
                            <span class="helper-text" data-error="@if($errors->has('categories')){{ $errors->first('categories') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                                <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-categories">
                            {{ trans('global.app_select_all') }}
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
                            {!! Form::label('tags', trans('global.trails.fields.tags').'') !!}
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

                <div class="col-12">
                    <div class="row">
                        <label>
                        <!-- {!! Form::label('approved', trans('global.users.fields.approved').'') !!} -->
                        {!! Form::hidden('approved', 0) !!}
                        {!! Form::checkbox('approved', 1, old('approved', old('approved')), []) !!}
                        <span>
                            @lang('global.trails.fields.approved')
                        </span>
                        <span class="helper-text" data-error="@if($errors->has('approved')){{ $errors->first('approved') }}@endif" data-success="right"></span>
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    {!! Form::label('introduction', trans('global.trails.fields.introduction').'') !!}
                    {!! Form::textarea('introduction', old('introduction'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <span class="helper-text" data-error="@if($errors->has('introduction')){{ $errors->first('introduction') }}@endif" data-success="right"></span>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn waves-effect waves-light grey white-text']) !!}
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