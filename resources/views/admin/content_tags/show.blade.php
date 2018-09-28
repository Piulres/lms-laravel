@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.content-tags.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.content_tags.index') }}">
                            @lang('global.content-tags.title')</a>
                    </li> /
                    <li><span>@lang('global.app_show')</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.content_tags.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                            <th>@lang('global.content-tags.fields.title')</th>
                            <td field-key='title'>{{ $content_tag->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.content-tags.fields.slug')</th>
                            <td field-key='slug'>{{ $content_tag->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#content_pages" aria-controls="content_pages">Pages</a></li>
            </ul>
        </div>

        <div class="content">
            <div role="tabpanel" class="tab-pane active" id="content_pages">
                <table class="striped responsive-table {{ count($content_pages) > 0 ? 'datatable' : '' }}">
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
                                        <div class="buttons">
                                            @can('content_page_view')
                                            <a href="{{ route('admin.content_pages.show',[$content_page->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('content_page_edit')
                                            <a href="{{ route('admin.content_pages.edit',[$content_page->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('content_page_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.content_pages.destroy', $content_page->id])) !!}
                                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
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
    </div>
@stop


