@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col l4 s12">
            <a href="{{ route('admin.users.index') }}" class="card-panel stats-card indigo lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-users"></i>
                <span class="count">{{ $users->count() }}</span>
                <div class="name">Users</div>
            </a>
        </div>

        <div class="col l4 s12">
            <a href="{{ route('admin.courses.index') }}" class="card-panel stats-card blue lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-book-reader"></i>
                <span class="count">{{ $courses->count() }}</span>
                <div class="name">Courses</div>
            </a>
        </div>

        <div class="col l4 s12">
            <a href="{{ route('admin.courses.index') }}" class="card-panel stats-card teal lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-train"></i>
                <span class="count">{{ $trails->count() }}</span>
                <div class="name">Trails</div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col l4 s12">
            <div class="card" draggable="false">
                <div class="title">
                    <h5>Users</h5>
                    {{--<a class="close" href="#" draggable="false">--}}
                        {{--<i class="mdi-content-clear"></i>--}}
                    {{--</a>--}}
                    <a class="minimize" href="#" draggable="false">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content orders-card">
                    @foreach($users as $user)
                    <h4>{{ $user->name }}</h4>
                    <div class="row">
                        <div class="col s6">
                            <small>Total Progress</small>
                        </div>
                        <div class="col s6 right-   align">77%
                        </div>
                    </div>
                    <div class="progress small">
                        <div class="determinate" style="width: 77%"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 card-home">
            <div class="card">
                <div class="card-title">
                    <h4>Recently added courses</h4>
                </div>

                <div class="card-content">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>

                            <th> @lang('global.courses.fields.title')</th>
                            <th> @lang('global.courses.fields.description')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($courses as $course)
                            <tr>

                                <td>{{ $course->title }} </td>
                                <td>{{ $course->description }} </td>
                                <td>

                                    <div class="buttons end">
                                        @can('course_view')
                                        <a href="{{ route('admin.courses.show',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square grey"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan

                                        @can('course_edit')
                                        <a href="{{ route('admin.courses.edit',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                        @endcan

                                        @can('course_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.courses.destroy', $course->id])) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('admin.courses.index') }}" class="waves-effect waves-light btn white black-text">@lang('global.app_see_all')</a>
                    <a href="{{ route('admin.courses.create') }}" class="waves-effect waves-light btn blue white-text">@lang('global.courses.create')</a>
                </div>
            </div>
        </div>


 
        <div class="col-lg-6 col-md-12 card-home">
            <div class="card">
                <div class="card-title">
                    <h4>Recently added trails</h4>
                </div>

                <div class="card-content">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>

                            <th> @lang('global.trails.fields.title')</th>
                            <th> @lang('global.trails.fields.description')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($trails as $trail)
                            <tr>

                                <td>{{ $trail->title }} </td>
                                <td>{{ $trail->description }} </td>
                                <td>

                                    <div class="buttons end">
                                        @can('trail_view')
                                        <a href="{{ route('admin.trails.show',[$trail->id]) }}" class="waves-effect waves-light btn-small btn-square grey"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan

                                        @can('trail_edit')
                                        <a href="{{ route('admin.trails.edit',[$trail->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                        @endcan

                                        @can('trail_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.trails.destroy', $trail->id])) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
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
            <div class="card">
                <div class="card-title">
                    <h4>Recently added faqquestions</h4>
                </div>

                <div class="card-content">
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
                                    <div class="buttons end">
                                        @can('faq_question_view')
                                        <a href="{{ route('admin.faq_questions.show',[$faqquestion->id]) }}" class="waves-effect waves-light btn-small btn-square grey"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan

                                        @can('faq_question_edit')
                                        <a href="{{ route('admin.faq_questions.edit',[$faqquestion->id]) }}" class="waves-effect waves-light btn-small btn-square blue"><i class="material-icons">edit</i></a>
                                        @endcan

                                        @can('faq_question_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.faq_questions.destroy', $faqquestion->id])) !!}
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                    </div>
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
