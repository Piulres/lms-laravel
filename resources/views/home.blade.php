@extends('layouts.app')

@section('content')
    <div class="row">
        
        <div class="col-lg-6 col-md-12 card-home">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        <h5>Recently added users</h5>
                    </div>
                    <table class="highlight responsive-table">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.users.fields.name') </th> 
                            <th> @lang('global.users.fields.email') </th> 
                            <th class="actions"> @lang('global.app_actions') </th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                               
                                <td>{{ $user->name }} </td> 
                                <td>{{ $user->email }} </td> 
                                <td class="actions">
                                    <div class="d-flex align-items-center justify-content-end">
                                        @can('user_view')
                                        <a href="{{ route('admin.users.show',[$user->id]) }}" class="waves-effect waves-light btn btn-small btn-square tooltipped" data-position="bottom" data-tooltip="@lang('global.app_view')"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan

                                        @can('user_edit')
                                        <a href="{{ route('admin.users.edit',[$user->id]) }}" class="waves-effect waves-light btn-small btn-square blue">
                                            <i class="material-icons">edit</i></a>
                                        @endcan

                                        @can('user_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.users.destroy', $user->id])) !!}
                                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('admin.users.index') }}" class="waves-effect waves-light btn white black-text">@lang('global.app_see_all')</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 card-home card-list">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        <h5>Recently added courses</h5>
                        <p class="text-subhead grey-text">Content</p>
                    </div>
                    <ul class="collection">
                        @foreach($courses as $course)
                        <li class="collection-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $course->title }}</span>
                                <div class="secondary-content d-flex flex-row align-items-center">
                                    <span class="progress grey lighten-4" style="width: 120px">
                                        <div class="determinate grey" style="width: 50%"></div>
                                    </span>
                                    <div class="actions hide-on-med-and-down">
                                        <div class="d-flex align-items-center justify-content-end">
                                            @can('course_view')
                                            <a href="{{ route('admin.courses.show',[$course->id]) }}" class="waves-effect waves-light btn btn-small btn-square tooltipped" data-position="bottom" data-tooltip="@lang('global.app_view')"><i class="material-icons">remove_red_eye</i></a>
                                            @endcan

                                            @can('course_edit')
                                            <a href="{{ route('admin.courses.edit',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square blue">
                                                <i class="material-icons">edit</i></a>
                                            @endcan

                                            @can('course_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                'route' => ['admin.courses.destroy', $course->id])) !!}
                                            {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('admin.courses.index') }}" class="waves-effect waves-light btn white black-text">@lang('global.app_see_all')</a>
                    <a href="{{ route('admin.courses.create') }}" class="waves-effect waves-light btn blue white-text">@lang('global.courses.create')</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 card-home">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        <h5>Recently added trails</h5>
                    </div>
                    <table class="highlight responsive-table">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.trails.fields.title') </th> 
                            <th class="actions"> @lang('global.app_actions') </th>
                        </tr>
                        </thead>
                        @foreach($trails as $trail)
                            <tr>
                               
                                <td>{{ $trail->title }} </td> 
                                <td class="actions">
                                    <div class="d-flex align-items-center justify-content-end">
                                        @can('trail_view')
                                        <a href="{{ route('admin.trails.show',[$trail->id]) }}" class="waves-effect waves-light btn btn-small btn-square tooltipped" data-position="bottom" data-tooltip="@lang('global.app_view')"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan

                                        @can('trail_edit')
                                        <a href="{{ route('admin.trails.edit',[$trail->id]) }}" class="waves-effect waves-light btn-small btn-square blue">
                                            <i class="material-icons">edit</i></a>
                                        @endcan

                                        @can('trail_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.trails.destroy', $trail->id])) !!}
                                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a class="waves-effect waves-light btn white black-text">@lang('global.app_see_all')</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 card-home">
            <div class="card blue lighten-2 white-text">
                <div class="card-content">
                    <div class="card-title">
                        <h5>Recently added teams</h5>
                    </div>

                    <table class="highlight responsive-table">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.teams.fields.name') </th> 
                            <th class="actions"> @lang('global.app_actions') </th>
                        </tr>
                        </thead>
                        @foreach($teams as $team)
                            <tr>
                               
                                <td>{{ $team->name }} </td> 
                                <td class="actions">
                                    <div class="d-flex align-items-center justify-content-end">
                                        @can('team_view')
                                        <a href="{{ route('admin.teams.show',[$team->id]) }}" class="waves-effect waves-light btn btn-small btn-square tooltipped" data-position="bottom" data-tooltip="@lang('global.app_view')"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan

                                        @can('team_edit')
                                        <a href="{{ route('admin.teams.edit',[$team->id]) }}" class="waves-effect waves-light btn-small btn-square blue">
                                            <i class="material-icons">edit</i></a>
                                        @endcan

                                        @can('team_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.teams.destroy', $team->id])) !!}
                                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection

