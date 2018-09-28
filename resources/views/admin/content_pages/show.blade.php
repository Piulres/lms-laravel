@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.content-pages.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.content_pages.index') }}">
                            @lang('global.content-pages.title')</a>
                    </li> /
                    <li><span>@lang('global.app_show')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.content_pages.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
                    @lang('global.app_back_to_list')
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="title">
            <h5>@lang('global.app_view')</h5>
        </div>

        <div class="content">
            <div class="row">
                <div class="col s6">
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

@stop
