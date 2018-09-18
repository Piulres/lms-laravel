@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.content-categories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.content-categories.fields.title')</th>
                            <td field-key='title'>{{ $content_category->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.content-categories.fields.slug')</th>
                            <td field-key='slug'>{{ $content_category->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#content_pages" aria-controls="content_pages" role="tab" data-toggle="tab">Pages</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="content_pages">
<table class="table table-bordered table-striped {{ count($content_pages) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.content-pages.fields.title')</th>
                        <th>@lang('global.content-pages.fields.category-id')</th>
                        <th>@lang('global.content-pages.fields.tag-id')</th>
                        <th>@lang('global.content-pages.fields.page-text')</th>
                        <th>@lang('global.content-pages.fields.excerpt')</th>
                        <th>@lang('global.content-pages.fields.featured-image')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($content_pages) > 0)
            @foreach ($content_pages as $content_page)
                <tr data-entry-id="{{ $content_page->id }}">
                    <td field-key='title'>{{ $content_page->title }}</td>
                                <td field-key='category_id'>
                                    @foreach ($content_page->category_id as $singleCategoryId)
                                        <span class="label label-info label-many">{{ $singleCategoryId->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='tag_id'>
                                    @foreach ($content_page->tag_id as $singleTagId)
                                        <span class="label label-info label-many">{{ $singleTagId->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='page_text'>{!! $content_page->page_text !!}</td>
                                <td field-key='excerpt'>{!! $content_page->excerpt !!}</td>
                                <td field-key='featured_image'>@if($content_page->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $content_page->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $content_page->featured_image) }}"/></a>@endif</td>
                                                                <td>
                                    @can('content_page_view')
                                    <a href="{{ route('admin.content_pages.show',[$content_page->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('content_page_edit')
                                    <a href="{{ route('admin.content_pages.edit',[$content_page->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('content_page_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.content_pages.destroy', $content_page->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.content_categories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


