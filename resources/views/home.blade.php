@extends('layouts.app')

<!-- @if ($check_role[0] == 1)
    Hello Admin
@else
    Hello standard user
@endif -->

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
    @if($mycoursetestimonals->count() != 0)
    <div class="row">
        <div class="col s12">
            <div class="card minimized">
                <div class="title">
                    <h5>Nos de seu feedback sobre o curso: {{$mycoursetestimonals[0]->title}}</h5>
                    <a class="minimize" href="#" draggable="false"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content">
                    {!! Form::open(['method' => 'POST', 'route' => ['admin.savecoursefeedback'], 'files' => true,]) !!}
                    <div id="testimonal-box">
                        <div class="col m1 s12">
                            <div class="input-field">
                                {!! Form::label('rating', trans('global.datacourse.fields.rating').'') !!}
                                    {!! Form::number('rating','value',['min'=>1,'max'=>5], old('rating'), ['class' => 'validate']) !!}
                                    <span class="helper-text" data-error="@if($errors->has('rating')){{ $errors->first('rating') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="input-field">
                                {!! Form::label('testimonal', trans('Feedback').'') !!}
                                {!! Form::textarea('testimonal', old('testimonal'), ['class' => 'materialize-textarea ']) !!}
                                <span class="helper-text" data-error="@if($errors->has('testimonal')){{ $errors->first('testimonal') }}@endif" data-success="right"></span>
                            </div>
                            <input type="hidden" value="{{ $mycoursetestimonals[0]->user_id }}" name="user_id">
                            <input type="hidden" value="{{ $mycoursetestimonals[0]->course_id }}" name="course_id">
                        </div>
                        <div class="col s12">
                            {!! Form::button(trans('global.app_save') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($mytrailtestimonals->count() != 0)
    <div class="row">
        <div class="col s12">
            <div class="card minimized">
                <div class="title">
                    <h5>Nos de seu feedback sobre a trail: {{$mytrailtestimonals[0]->title}}</h5>
                    <a class="minimize" href="#" draggable="false"><i class="mdi-navigation-expand-less"></i></a>
                </div>
                <div class="content">
                    {!! Form::open(['method' => 'POST', 'route' => ['admin.savetrailfeedback'], 'files' => true,]) !!}
                    <div id="testimonal-box">
                        <div class="col m1 s12">
                            <div class="input-field">
                                {!! Form::label('rating', trans('global.datatrail.fields.rating').'') !!}
                                    {!! Form::number('rating','value',['min'=>1,'max'=>5], old('rating'), ['class' => 'validate']) !!}
                                    <span class="helper-text" data-error="@if($errors->has('rating')){{ $errors->first('rating') }}@endif" data-success="right"></span>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="input-field">
                                {!! Form::label('testimonal', trans('Feedback').'') !!}
                                {!! Form::textarea('testimonal', old('testimonal'), ['class' => 'materialize-textarea ']) !!}
                                <span class="helper-text" data-error="@if($errors->has('testimonal')){{ $errors->first('testimonal') }}@endif" data-success="right"></span>
                            </div>
                            <input type="hidden" value="{{ $mytrailtestimonals[0]->user_id }}" name="user_id">
                            <input type="hidden" value="{{ $mytrailtestimonals[0]->trail_id }}" name="trail_id">
                        </div>
                        <div class="col s12">
                            {!! Form::button(trans('global.app_save') . '<i class="material-icons right">send</i>', ['class'=>'btn waves-effect waves-light right', 'type'=>'submit']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- <div class="row">
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
        
    </div> -->

    <div class="row">

        <div class="col l2 s12">
            <a href="{{ route('admin.courses.index') }}"
               class="card-panel stats-card blue lighten-2 white-text text-lighten-5">
                <i class="fas fa-book-reader"></i>
                <span class="count">{{ $courses->count() }}</span>
                <div class="name">Courses</div>
            </a>
        </div>

        <div class="col l2 s12">
            <a href="{{ route('admin.courses.create') }}"
               class="card-panel stats-card blue lighten-2 white-text text-lighten-5">
                <i class="fas fa-plus-circle"></i>
                <span class="count">New</span>
                <div class="name">Course</div>
            </a>
        </div>

        <div class="col l2 s12">
            <a href="{{ route('admin.users.index') }}"
               class="card-panel stats-card orange lighten-2 white-text text-lighten-5">
                <i class="fas fa-users"></i>
                <span class="count">{{ $users->count() }}</span>
                <div class="name">Users</div>
            </a>
        </div>

        <div class="col l2 s12">
            <a href="{{ route('admin.users.create') }}"
               class="card-panel stats-card orange lighten-2 white-text text-lighten-5">
                <i class="fas fa-plus-circle"></i>
                <span class="count">New</span>
                <div class="name">User</div>
            </a>
        </div>        

        <div class="col l2 s12">
            <a href="{{ route('admin.trails.index') }}"
               class="card-panel stats-card green lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-train"></i>
                <span class="count">{{ $trails->count() }}</span>
                <div class="name">Trails</div>
            </a>
        </div>

        <div class="col l2 s12">
            <a href="{{ route('admin.messenger.index') }}"
               class="card-panel stats-card purple lighten-2 indigo-text text-lighten-5">
                <i class="fas fa-comments"></i>
                <span class="count">{{ $mymessages->count() }}</span>
                <div class="name">Messages</div>
            </a>
        </div>

        <div class="col l5 s12">
            <div class="card" draggable="false">
                <div class="title">
                    <h5>Your recent Courses</h5>
                    <a class="minimize" href="#" draggable="false">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content orders-card">
                    @foreach($mycourses as $mycourse)
                        <h4><a class="black-text" href="{{ url('courses/'. $mycourse->course_id) }}">{{ $mycourse->title }}</a></h4>

                        <div class="row">
                            <div class="col s6">
                                <small>Total Progress</small>
                            </div>
                            <div class="col s6 right-align">
                                @if ($mycourse->progress === null)
                                0 %
                                @else
                                {{ $mycourse->progress }} %
                                @endif
                            </div>
                        </div>
                        <div class="progress small">                            
                            <div class="determinate" style="width: {{ $mycourse->progress }}%"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col l7 s12">
             <div class="card" draggable="false">
                <div class="title">
                    <h5>Courses Analysis </h5>
                    <a class="minimize" href="#" draggable="false">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>

                <div class="content orders-card">

                    <div class="row">
                        <div id="canvas-holder">
                            <canvas id="chart-area"></canvas>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <button class="btn waves-effect waves-light" id="randomizeData">Randomize Data</button>
                        <button class="btn waves-effect waves-light" id="addDataset">Add Dataset</button>
                        <button class="btn waves-effect waves-light" id="removeDataset">Remove Dataset</button>
                    </div>

                    <script>
                        'use strict';

                        window.chartColors = {
                            red: 'rgb(255, 99, 132)',
                            orange: 'rgb(255, 159, 64)',
                            yellow: 'rgb(255, 205, 86)',
                            green: 'rgb(75, 192, 192)',
                            blue: 'rgb(54, 162, 235)',
                            purple: 'rgb(153, 102, 255)',
                            grey: 'rgb(201, 203, 207)'
                        };

                        (function(global) {
                            var Months = [
                                'January',
                                'February',
                                'March',
                                'April',
                                'May',
                                'June',
                                'July',
                                'August',
                                'September',
                                'October',
                                'November',
                                'December'
                            ];

                            var COLORS = [
                                '#4dc9f6',
                                '#f67019',
                                '#f53794',
                                '#537bc4',
                                '#acc236',
                                '#166a8f',
                                '#00a950',
                                '#58595b',
                                '#8549ba'
                            ];

                            var Samples = global.Samples || (global.Samples = {});
                            var Color = global.Color;

                            Samples.utils = {
                                // Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
                                srand: function(seed) {
                                    this._seed = seed;
                                },

                                rand: function(min, max) {
                                    var seed = this._seed;
                                    min = min === undefined ? 0 : min;
                                    max = max === undefined ? 1 : max;
                                    this._seed = (seed * 9301 + 49297) % 233280;
                                    return min + (this._seed / 233280) * (max - min);
                                },

                                numbers: function(config) {
                                    var cfg = config || {};
                                    var min = cfg.min || 0;
                                    var max = cfg.max || 1;
                                    var from = cfg.from || [];
                                    var count = cfg.count || 8;
                                    var decimals = cfg.decimals || 8;
                                    var continuity = cfg.continuity || 1;
                                    var dfactor = Math.pow(10, decimals) || 0;
                                    var data = [];
                                    var i, value;

                                    for (i = 0; i < count; ++i) {
                                        value = (from[i] || 0) + this.rand(min, max);
                                        if (this.rand() <= continuity) {
                                            data.push(Math.round(dfactor * value) / dfactor);
                                        } else {
                                            data.push(null);
                                        }
                                    }

                                    return data;
                                },

                                labels: function(config) {
                                    var cfg = config || {};
                                    var min = cfg.min || 0;
                                    var max = cfg.max || 100;
                                    var count = cfg.count || 8;
                                    var step = (max - min) / count;
                                    var decimals = cfg.decimals || 8;
                                    var dfactor = Math.pow(10, decimals) || 0;
                                    var prefix = cfg.prefix || '';
                                    var values = [];
                                    var i;

                                    for (i = min; i < max; i += step) {
                                        values.push(prefix + Math.round(dfactor * i) / dfactor);
                                    }

                                    return values;
                                },

                                months: function(config) {
                                    var cfg = config || {};
                                    var count = cfg.count || 12;
                                    var section = cfg.section;
                                    var values = [];
                                    var i, value;

                                    for (i = 0; i < count; ++i) {
                                        value = Months[Math.ceil(i) % 12];
                                        values.push(value.substring(0, section));
                                    }

                                    return values;
                                },

                                color: function(index) {
                                    return COLORS[index % COLORS.length];
                                },

                                transparentize: function(color, opacity) {
                                    var alpha = opacity === undefined ? 0.5 : 1 - opacity;
                                    return Color(color).alpha(alpha).rgbString();
                                }
                            };

                            // DEPRECATED
                            window.randomScalingFactor = function() {
                                return Math.round(Samples.utils.rand(-100, 100));
                            };

                            // INITIALIZATION

                            Samples.utils.srand(Date.now());

                            // Google Analytics
                            /* eslint-disable */
                            if (document.location.hostname.match(/^(www\.)?chartjs\.org$/)) {
                                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                                ga('create', 'UA-28909194-3', 'auto');
                                ga('send', 'pageview');
                            }
                            /* eslint-enable */

                        }(this));
                        var randomScalingFactor = function() {
                            return Math.round(Math.random() * 100);
                        };
                        var config = {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    data: [
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                    ],
                                    backgroundColor: [
                                        window.chartColors.red,
                                        window.chartColors.orange,
                                        window.chartColors.yellow,
                                        window.chartColors.green,
                                        window.chartColors.blue,
                                    ],
                                    label: 'Dataset 1'
                                }],
                                labels: [
                                    'Curso 01',
                                    'Curso 02',
                                    'Curso 03',
                                    'Curso 04',
                                    'Curso 05'
                                ]
                            },
                            options: {
                                responsive: true
                            }
                        };
                        window.onload = function() {
                            var ctx = document.getElementById('chart-area').getContext('2d');
                            window.myPie = new Chart(ctx, config);
                        };
                        document.getElementById('randomizeData').addEventListener('click', function() {
                            config.data.datasets.forEach(function(dataset) {
                                dataset.data = dataset.data.map(function() {
                                    return randomScalingFactor();
                                });
                            });
                            window.myPie.update();
                        });
                        var colorNames = Object.keys(window.chartColors);
                        document.getElementById('addDataset').addEventListener('click', function() {
                            var newDataset = {
                                backgroundColor: [],
                                data: [],
                                label: 'New dataset ' + config.data.datasets.length,
                            };
                            for (var index = 0; index < config.data.labels.length; ++index) {
                                newDataset.data.push(randomScalingFactor());
                                var colorName = colorNames[index % colorNames.length];
                                var newColor = window.chartColors[colorName];
                                newDataset.backgroundColor.push(newColor);
                            }
                            config.data.datasets.push(newDataset);
                            window.myPie.update();
                        });
                        document.getElementById('removeDataset').addEventListener('click', function() {
                            config.data.datasets.splice(0, 1);
                            window.myPie.update();
                        });
                    </script>

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
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['class'=>'waves-effect waves-light btn-small btn-square red-text', 'type'=>'submit']) !!}
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
