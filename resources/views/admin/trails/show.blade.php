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
                    <li><span>{{ $trail->title }}</span></li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="{{ route('admin.trails.index') }}" class="btn lighten-3 z-depth-0 chat-toggle">
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
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('global.trails.fields.order')</th>
                            <td field-key='order'>{{ $trail->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.title')</th>
                            <td field-key='title'>{{ $trail->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.slug')</th>
                            <td field-key='slug'>{{ $trail->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.description')</th>
                            <td field-key='description'>{!! $trail->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.introduction')</th>
                            <td field-key='introduction'>{!! $trail->introduction !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.featured-image')</th>
                            <td field-key='featured_image'>{{ $trail->featured_image }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.courses')</th>
                            <td field-key='courses'>
                                @foreach ($trail->courses as $singleCourses)
                                    <span class="label label-info label-many">{{ $singleCourses->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.start-date')</th>
                            <td field-key='start_date'>{{ $trail->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.end-date')</th>
                            <td field-key='end_date'>{{ $trail->end_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.categories')</th>
                            <td field-key='categories'>
                                @foreach ($trail->categories as $singleCategories)
                                    <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.tags')</th>
                            <td field-key='tags'>
                                @foreach ($trail->tags as $singleTags)
                                    <span class="label label-info label-many">{{ $singleTags->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.trails.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $trail->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-tabs">
            <ul class="shuffle-tabs tabs tabs-fixed-width">
                <li class="tab grey-text active"><a class="grey-text" href="#datatrail">Data Trail</a></li>
            </ul>
        </div>

        <div class="content">
            
            <div role="tabpanel" class="tab-pane active" id="datatrail">
                <table class="striped responsive-table {{ count($datatrails) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>@lang('global.datatrail.fields.view')</th>
                            <th>@lang('global.datatrail.fields.progress')</th>
                            <th>@lang('global.datatrail.fields.rating')</th>
                            <th>@lang('global.datatrail.fields.testimonal')</th>
                            <th>@lang('global.datatrail.fields.user')</th>
                            <th>@lang('global.datatrail.fields.trail')</th>
                            <th>@lang('global.datatrail.fields.certificate')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($datatrails) > 0)
                            @foreach ($datatrails as $datatrail)
                                <tr data-entry-id="{{ $datatrail->id }}">
                                    <td field-key='view'>{{ $datatrail->view }}</td>
                                    <td field-key='progress'>{{ $datatrail->progress }}</td>
                                    <td field-key='rating'>{{ $datatrail->rating }}</td>
                                    <td field-key='testimonal'>{!! $datatrail->testimonal !!}</td>
                                    <td field-key='user'>{{ $datatrail->user->name or '' }}</td>
                                    <td field-key='trail'>{{ $datatrail->trail->title or '' }}</td>
                                    <td field-key='certificate'>{{ $datatrail->certificate->title or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        <div class="buttons">
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'POST',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.datatrails.restore', $datatrail->id])) !!}
                                            {!! Form::submit(trans('global.app_restore'), array('class' => 'btn-square blue-text')) !!}
                                            {!! Form::close() !!}
                                                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.datatrails.perma_del', $datatrail->id])) !!}
                                            {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn-square red-text')) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                    @else
                                    <td>
                                        <div class="buttons">
                                            @can('datatrail_view')
                                            <a href="{{ route('admin.datatrails.show',[$datatrail->id]) }}" class="waves-effect waves-light btn-small btn-square amber-text"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan
                                            @can('datatrail_edit')
                                            <a href="{{ route('admin.datatrails.edit',[$datatrail->id]) }}" class="waves-effect waves-light btn-small btn-square blue-text"><i class="material-icons">edit</i></a>
                                            @endcan
                                            @can('datatrail_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.datatrails.destroy', $datatrail->id])) !!}
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
                                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
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
            
@stop
