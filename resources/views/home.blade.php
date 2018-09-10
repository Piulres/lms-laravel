@extends('layouts.app')

@section('content')
    <div class="row">
        
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added users</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.users.fields.name')</th> 
                            <th> @lang('global.users.fields.last-name')</th> 
                            <th> @lang('global.users.fields.email')</th> 
                            <th> @lang('global.users.fields.website')</th> 
                            <th> @lang('global.users.fields.approved')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                               
                                <td>{{ $user->name }} </td> 
                                <td>{{ $user->last_name }} </td> 
                                <td>{{ $user->email }} </td> 
                                <td>{{ $user->website }} </td> 
                                <td>{{ $user->approved }} </td> 
                                <td>

                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('user_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added courses</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.courses.fields.title')</th> 
                            <th> @lang('global.courses.fields.description')</th> 
                            <th> @lang('global.courses.fields.introduction')</th> 
                            <th> @lang('global.courses.fields.duration')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($courses as $course)
                            <tr>
                               
                                <td>{{ $course->title }} </td> 
                                <td>{{ $course->description }} </td> 
                                <td>{{ $course->introduction }} </td> 
                                <td>{{ $course->duration }} </td> 
                                <td>

                                    @can('course_view')
                                    <a href="{{ route('admin.courses.show',[$course->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('course_edit')
                                    <a href="{{ route('admin.courses.edit',[$course->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('course_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.courses.destroy', $course->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
                                    </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added trails</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.trails.fields.title')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($trails as $trail)
                            <tr>
                               
                                <td>{{ $trail->title }} </td> 
                                <td>

                                    @can('trail_view')
                                    <a href="{{ route('admin.trails.show',[$trail->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('trail_edit')
                                    <a href="{{ route('admin.trails.edit',[$trail->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('trail_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.trails.destroy', $trail->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added teams</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.teams.fields.name')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($teams as $team)
                            <tr>
                               
                                <td>{{ $team->name }} </td> 
                                <td>

                                    @can('team_view')
                                    <a href="{{ route('admin.teams.show',[$team->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('team_edit')
                                    <a href="{{ route('admin.teams.edit',[$team->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('team_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.teams.destroy', $team->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection

