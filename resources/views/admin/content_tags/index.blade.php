@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h2>@lang('global.content-tags.title')</h2>
        @can('content_tag_create')
            <a href="{{ route('admin.content_tags.create') }}" class="btn-floating btn-small waves-effect waves-light grey"><i class="material-icons">add</i></a>
        @endcan
    </div>

    <div class="card">
        <div class="card-title">
            <h3>@lang('global.app_list')</h3>
        </div>

        <div class="card-content">
            <table class="striped responsive-table {{ count($content_tags) > 0 ? 'datatable' : '' }} @can('content_tag_delete') dt-select @endcan">
                <thead>
                    <tr>
                        <th class="order-null"></th>
                        @can('content_tag_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.content-tags.fields.title')</th>
                        <th>@lang('global.content-tags.fields.slug')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($content_tags) > 0)
                        @foreach ($content_tags as $content_tag)
                            <tr data-entry-id="{{ $content_tag->id }}">
                                <td class="order-null"></td>
                                @can('content_tag_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $content_tag->title }}</td>
                                <td field-key='slug'>{{ $content_tag->slug }}</td>
                                    <td>
                                    <div class="buttons d-flex justify-content">
                                        @can('content_tag_view')
                                        <a href="{{ route('admin.content_tags.show',[$content_tag->id]) }}" class="waves-effect waves-light btn-small btn-square amber"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                        @can('content_tag_edit')
                                        <a href="{{ route('admin.content_tags.edit',[$content_tag->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                        @endcan
                                        @can('content_tag_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.content_tags.destroy', $content_tag->id])) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('content_tag_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.content_tags.mass_destroy') }}';
        @endcan

    </script>
@endsection