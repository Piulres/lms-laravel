@extends('layouts.app')

@section('content')
    <div class="back-button">
        <a href="{{ route('admin.content_pages.index') }}" class="waves-effect waves-light btn-small grey">@lang('global.app_back_to_list')</a>
    </div>
    <div class="header-title">
        <h2>@lang('global.content-pages.title')</h2>
    </div>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_view')</h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-md-6">
                    <table class="bordered striped">
                        <tr>
                            <th>@lang('global.content-pages.fields.title')</th>
                            <td field-key='title'>{{ $content_page->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.content-pages.fields.category-id')</th>
                            <td field-key='category_id'>
                                @foreach ($content_page->category_id as $singleCategoryId)
                                    <span class="label label-info label-many">{{ $singleCategoryId->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.content-pages.fields.tag-id')</th>
                            <td field-key='tag_id'>
                                @foreach ($content_page->tag_id as $singleTagId)
                                    <span class="label label-info label-many">{{ $singleTagId->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.content-pages.fields.page-text')</th>
                            <td field-key='page_text'>{!! $content_page->page_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.content-pages.fields.excerpt')</th>
                            <td field-key='excerpt'>{!! $content_page->excerpt !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.content-pages.fields.featured-image')</th>
                            <td field-key='featured_image'>@if($content_page->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $content_page->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $content_page->featured_image) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
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

@stop
