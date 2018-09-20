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
                            <th> @lang('global.users.fields.lastname')</th>
                            <th> @lang('global.users.fields.website')</th>
                            <th> @lang('global.users.fields.email')</th>
                            <th> @lang('global.users.fields.approved')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr>

                                <td>{{ $user->name }} </td>
                                <td>{{ $user->lastname }} </td>
                                <td>{{ $user->website }} </td>
                                <td>{{ $user->email }} </td>
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

                            <th> @lang('global.courses.fields.order')</th>
                            <th> @lang('global.courses.fields.title')</th>
                            <th> @lang('global.courses.fields.slug')</th>
                            <th> @lang('global.courses.fields.description')</th>
                            <th> @lang('global.courses.fields.introduction')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($courses as $course)
                            <tr>

                                <td>{{ $course->order }} </td>
                                <td>{{ $course->title }} </td>
                                <td>{{ $course->slug }} </td>
                                <td>{{ $course->description }} </td>
                                <td>{{ $course->introduction }} </td>
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

                            <th> @lang('global.trails.fields.order')</th>
                            <th> @lang('global.trails.fields.title')</th>
                            <th> @lang('global.trails.fields.slug')</th>
                            <th> @lang('global.trails.fields.description')</th>
                            <th> @lang('global.trails.fields.introduction')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($trails as $trail)
                            <tr>

                                <td>{{ $trail->order }} </td>
                                <td>{{ $trail->title }} </td>
                                <td>{{ $trail->slug }} </td>
                                <td>{{ $trail->description }} </td>
                                <td>{{ $trail->introduction }} </td>
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
                <div class="panel-heading">Recently added faqquestions</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>

                            <th> @lang('global.faq-questions.fields.question-text')</th>
                            <th> @lang('global.faq-questions.fields.answer-text')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($faqquestions as $faqquestion)
                            <tr>

                                <td>{{ $faqquestion->question_text }} </td>
                                <td>{{ $faqquestion->answer_text }} </td>
                                <td>

                                    @can('faq_question_view')
                                    <a href="{{ route('admin.faq_questions.show',[$faqquestion->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('faq_question_edit')
                                    <a href="{{ route('admin.faq_questions.edit',[$faqquestion->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('faq_question_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.faq_questions.destroy', $faqquestion->id])) !!}
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
