@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.content_pages.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.content-pages.title')</h2>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.content_pages.store'], 'files' => true,]) !!}

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_create')</h3>
        </div>
        
        <div class="card-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.content-pages.fields.title').'*') !!}
                        {!! Form::text('title', old('title'), ['class' => 'validate', 'required' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('title')){{ $errors->first('title') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('category_id', trans('global.content-pages.fields.category-id').'') !!}
                            {!! Form::select('category_id[]', $category_ids, old('category_id'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-category_id' ]) !!}
                            <span class="helper-text" data-error="@if($errors->has('category_id')){{ $errors->first('category_id') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-category_id">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-category_id">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 no-padding">
                            {!! Form::label('tag_id', trans('global.content-pages.fields.tag-id').'') !!}
                            {!! Form::select('tag_id[]', $tag_ids, old('tag_id'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'selectall-tag_id' ]) !!}
                            <span class="helper-text" data-error="@if($errors->has('tag_id')){{ $errors->first('tag_id') }}@endif" data-success="right"></span>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="selectbtn-tag_id">
                                {{ trans('global.app_select_all') }}
                            </button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button type="button" class="waves-effect waves-light btn-small grey" id="deselectbtn-tag_id">
                                {{ trans('global.app_deselect_all') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('excerpt', trans('global.content-pages.fields.excerpt').'') !!}
                        {!! Form::textarea('excerpt', old('excerpt'), ['class' => 'materialize-textarea', 'placeholder' => '']) !!}
                        <span class="helper-text" data-error="@if($errors->has('excerpt')){{ $errors->first('excerpt') }}@endif" data-success="right"></span>
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
                        {!! Form::hidden('featured_image_max_size', 10) !!}
                        {!! Form::hidden('featured_image_max_width', 1000) !!}
                        {!! Form::hidden('featured_image_max_height', 1000) !!}
                        <span class="helper-text" data-error="@if($errors->has('featured_image')){{ $errors->first('featured_image') }}@endif" data-success="right"></span>
                    </div>
                </div>

                <div class="col-12 col-md-12">
                    {!! Form::label('page_text', trans('global.content-pages.fields.page-text').'') !!}
                    {!! Form::textarea('page_text', old('page_text'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <span class="helper-text" data-error="@if($errors->has('page_text')){{ $errors->first('page_text') }}@endif" data-success="right"></span>
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

    <script>
        $("#selectbtn-category_id").click(function(){
            $("#selectall-category_id > option").prop("selected","selected");
            $("#selectall-category_id").trigger("change");
        });
        $("#deselectbtn-category_id").click(function(){
            $("#selectall-category_id > option").prop("selected","");
            $("#selectall-category_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-tag_id").click(function(){
            $("#selectall-tag_id > option").prop("selected","selected");
            $("#selectall-tag_id").trigger("change");
        });
        $("#deselectbtn-tag_id").click(function(){
            $("#selectall-tag_id > option").prop("selected","");
            $("#selectall-tag_id").trigger("change");
        });
    </script>
@stop