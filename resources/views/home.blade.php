@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10"><h1>Dashboard</h1>
                <ul>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">

        @if($mytestimonals->count() != 0)

        {!! Form::open(['method' => 'POST', 'route' => ['admin.savefeedback'], 'files' => true,]) !!}

            <div id="testimonal-box" class="col-lg-12 col-md-12">
                <h5>Nos de seu feedback sobre o curso: {{$mytestimonals[0]->title}}</h5>
                <div class="col-12 col-md-12">
                    <div class="input-field">
                        {!! Form::label('rating', trans('global.datacourse.fields.rating').'') !!}
                        {!! Form::number('rating', old('rating'), ['class' => 'validate']) !!}
                        <span class="helper-text" data-error="@if($errors->has('rating')){{ $errors->first('rating') }}@endif" data-success="right"></span>
                    </div>
                    <div class="input-field">
                        {!! Form::label('testimonal', trans('Feedback').'') !!}
                        {!! Form::textarea('testimonal', old('testimonal'), ['class' => 'materialize-textarea ']) !!}
                        <span class="helper-text" data-error="@if($errors->has('testimonal')){{ $errors->first('testimonal') }}@endif" data-success="right"></span>
                    </div>
                    <input type="hidden" value="{{ $mytestimonals[0]->user_id }}" name="user_id">                        
                    <input type="hidden" value="{{ $mytestimonals[0]->course_id }}" name="course_id">      
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn waves-effect waves-light black white-text']) !!}
                    {!! Form::close() !!}                  
                </div>        
            </div> 

        @endif

    </div>

    <div class="row">

        <div class="col s12 m3">
            <div class="card-panel red">
                <span class="white-text">
                    I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
                </span>
            </div>
        </div>
    
        <div class="col s12 m3">
            <div class="card-panel yellow">
                <span class="white-text">
                    I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
                </span>
            </div>
        </div>
    
        <div class="col s12 m3">
            <div class="card-panel blue">
                <span class="white-text">
                    I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
                </span>
            </div>
        </div>
    
        <div class="col s12 m3">
            <div class="card-panel green">
                <span class="white-text">
                    I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
                </span>
            </div>
        </div>
        
    </div>


@endsection

    <!-- WIDGETS -->

    <!-- 
    <div class="row">

        <div class="col l4 s12">
            <a href="{{ route('admin.users.index') }}"
               class="card-panel stats-card indigo lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-users"></i>
                <span class="count">{{ $users->count() }}</span>
                <div class="name">Users</div>
            </a>
        </div>

        <div class="col l4 s12">
            <a href="{{ route('admin.courses.index') }}"
               class="card-panel stats-card blue lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-book-reader"></i>
                <span class="count">{{ $courses->count() }}</span>
                <div class="name">Courses</div>
            </a>
        </div>

        <div class="col l4 s12">
            <a href="{{ route('admin.trails.index') }}"
               class="card-panel stats-card teal lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-train"></i>
                <span class="count">{{ $trails->count() }}</span>
                <div class="name">Trails</div>
            </a>
        </div>

        <div class="col l4 s12">
            <div class="card" draggable="false">
                <div class="title">
                    <h5>Recently added users</h5>
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
                            <div class="col s6 right-align">77%
                            </div>
                        </div>
                        <div class="progress small">
                            <div class="determinate" style="width: 77%"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col l4 s12">
            <div class="card">
                <div class="title">
                    <h5>Recently added courses</h5>
                    <a class="minimize" href="#"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content todo-card">
                    <ul class="collection">
                        @foreach($courses as $course)
                        <li class="collection-item">
                            <div>{{ $course->title }}
                                {!! Form::open(array(
                                    'class' => 'secondary-content',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.courses.destroy', $course->id])) !!}
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col l4 s12">
            <div class="card">
                <div class="title">
                    <h5>Recently added trails</h5>
                    {{--<a class="close" href="#"><i class="mdi-content-clear"></i></a>--}}
                    <a class="minimize" href="#"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content todo-card">
                    <ul class="collection">
                        @foreach($trails as $trail)
                        <li class="collection-item">
                            <div>
                                {{ $trail->title }}
                                {!! Form::open(array(
                                    'class' => 'secondary-content',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.courses.destroy', $course->id])) !!}
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col l4 s12">
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

        <div class="col l4 s12">
            <div class="card">
                <div class="card-title">
                    <h4>Certificates</h4>
                </div>

                <div class="card-content">
                    <table class="table table-bordered table-striped ajaxTable">

                        @foreach($certificates as $certificate)
                            <tr>

                                <td>{{ $certificate->id }} </td>
                                <td>{{ $certificate->title }} </td>
                                <td>

                                    <div class="buttons end">
                                        @can('coursecertificate_view')
                                        <a href="{{ route('admin.courses.show',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square grey"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

        <div class="col l4 s12">
            <div class="card">
                <div class="card-title">
                    <h4>My Certificates</h4>
                </div>

                <div class="card-content">
                    <table class="table table-bordered table-striped ajaxTable">

                        @foreach($mycertificates as $mycertificate)
                            <tr>

                                <td>{{ $mycertificate->certificate_id }} </td>
                                <td>{{ $mycertificate->title }} </td>
                                <td>

                                    <div class="buttons end">
                                        @can('coursecertificate_view')
                                        <a href="{{ route('admin.courses.show',[$course->id]) }}" class="waves-effect waves-light btn-small btn-square grey"><i class="material-icons">remove_red_eye</i></a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

        <div class="col l4 s12">
            <table class="table table-bordered table-striped ajaxTable">
                @foreach($certificates as $certificate)
                    <tr>

                        <td>id: {{ $certificate->id }} </td>
                        <td>{{ $certificate->title }} </td>
                        
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="col l4 s12">
            <table class="table table-bordered table-striped ajaxTable">
                @foreach($mycertificates as $mycertificate)
                    <tr>

                        <td>id: {{ $mycertificate->certificate_id }} </td>
                        <td>{{ $mycertificate->title }} </td>
                        
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    -->
