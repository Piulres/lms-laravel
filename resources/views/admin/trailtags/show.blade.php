@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>@lang('global.trailtags.title')</h1>
                <ul>
                    <li>
                        <a href="{{ url('/admin/home') }}">
                            <i class="fa fa-home"></i>
                            Dashboard</a>
                    </li> /
                    <li>
                        <a href="{{ route('admin.trailtags.index') }}">
                            @lang('global.trailtags.title')</a>
                    </li> /
                    <li><span>{{ $trailtag->title }}</li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.trailtags.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                    <table class="striped responsive-table">
                        <tr>
                            <th>@lang('global.trailtags.fields.title')</th>
                            <td field-key='title'>{{ $trailtag->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trailtags.fields.slug')</th>
                            <td field-key='slug'>{{ $trailtag->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text"><a class="grey-text" href="#trails">Trails</a></li>
            </ul>
        </div>
        <!-- Tab panes -->
        <div class="content">
            
            <div class="active" id="trails">
                <table class="striped responsive-table {{ count($trails) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>@lang('global.trails.fields.order')</th>
                            <th>@lang('global.trails.fields.title')</th>
                            {{--<th>@lang('global.trails.fields.slug')</th>--}}
                            {{--<th>@lang('global.trails.fields.description')</th>--}}
                            {{--<th>@lang('global.trails.fields.introduction')</th>--}}
                            {{--<th>@lang('global.trails.fields.featured-image')</th>--}}
                            {{--<th>@lang('global.trails.fields.courses')</th>--}}
                            <th>@lang('global.trails.fields.start-date')</th>
                            <th>@lang('global.trails.fields.end-date')</th>
                            {{--<th>@lang('global.trails.fields.categories')</th>--}}
                            {{--<th>@lang('global.trails.fields.tags')</th>--}}
                            <th>@lang('global.trails.fields.approved')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($trails) > 0)
                            @foreach ($trails as $trail)
                                <tr data-entry-id="{{ $trail->id }}">
                                    <td field-key='order'>{{ $trail->order }}</td>
                                    <td field-key='title'>{{ $trail->title }}</td>
                                    {{--<td field-key='slug'>{{ $trail->slug }}</td>--}}
                                    {{--<td field-key='description'>{!! $trail->description !!}</td>--}}
                                    {{--<td field-key='introduction'>{!! $trail->introduction !!}</td>--}}
                                    {{--<td field-key='featured_image'>{{ $trail->featured_image }}</td>--}}
                                    {{--<td field-key='courses'>--}}
                                        {{--@foreach ($trail->courses as $singleCourses)--}}
                                            {{--<span class="label label-info label-many">{{ $singleCourses->title }}</span>--}}
                                        {{--@endforeach--}}
                                    {{--</td>--}}
                                    <td field-key='start_date'>{{ $trail->start_date }}</td>
                                    <td field-key='end_date'>{{ $trail->end_date }}</td>
                                    {{--<td field-key='categories'>--}}
                                        {{--@foreach ($trail->categories as $singleCategories)--}}
                                            {{--<span class="label label-info label-many">{{ $singleCategories->title }}</span>--}}
                                        {{--@endforeach--}}
                                    {{--</td>--}}
                                    {{--<td field-key='tags'>--}}
                                        {{--@foreach ($trail->tags as $singleTags)--}}
                                            {{--<span class="label label-info label-many">{{ $singleTags->title }}</span>--}}
                                        {{--@endforeach--}}
                                    {{--</td>--}}
                                    <td field-key='approved'>{{ Form::checkbox("approved", 1, $trail->approved == 1 ? true : false, ["disabled"]) }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.trails.restore', $trail->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn-square blue-text')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.trails.perma_del', $trail->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn-square red-text')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        <div class="buttons">
                                            @can('trail_view')
                                            <a href="{{ route('admin.trails.show',[$trail->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('trail_edit')
                                            <a href="{{ route('admin.trails.edit',[$trail->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('trail_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.trails.destroy', $trail->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop


